/*-----------------------------------------------------------------------------

In dieser Datei werden alle Prozeduren und Funktionen implementiert, die der Buchungsverwaltung angehören.

*/-----------------------------------------------------------------------------




/*------------------------------p_SetBooking---------------------------*/
/*
Fuktionalität:  Dieser Prozedur werden die Buchungsdaten übergeben und sie trägt diese in die Tabellen BOOKING, BOOKINGDETAIL und GUEST ein.
Verfasser:      Max Schelenz
*/


/*
1. Einlesen AdressInformationen, Kundeninformationen, Buchungsinformationen
2. Anlegen der Adresse
3. Rückgabe der AdressID
4. Anlegen Guest
5. Berechnung Aufschlag
    5.1 GetAreaID
    5.2 GetSeasonID (mit Datum aus Buchungsinformationen)
    5.3 Errechne Prozent (mit Anzahl Besucher, Season und Area)
6. Rückgabe SURCHARGE ID (Das Kannst du glaube mit der Funktion MAX(SurchargeID) FROM SURCHARGE; machen)
7. Anlegen der Buchung in BOOKING
8. Anlegen der Details in BOOKINGDETAIL
    8.1 Berechnung Endpreis
*/
DELIMITER $$
create or replace procedure p_SetBooking    (
                                            /*Informationen zur Adresse*/
                                            IN inStreet varchar(50), IN inHnumber int, IN inZipCode char(5), IN inCity varchar(50), IN inState varchar(50),
                                            /*Informationen zum Gast*/
                                            IN inFirstName varchar(30), IN inLastName varchar(50), IN inDateOfBirth date, IN inMail varchar(200),
                                            /*Informationen zur Buchung*/
                                            IN inStartDateRent date, IN inEndDateRent date, IN inRentalID int, IN inNumberOfVisitors int
                                            )
    
	BEGIN
        
		DECLARE inDateBooking date;
        DECLARE inAddrID integer;
        DECLARE inGuestID integer;
        DECLARE inSeasonID integer; 
        DECLARE inAreaID integer;
        DECLARE inPercent decimal(5,2);
        DECLARE inSurchargeID integer;
        DECLARE inStatus enum('R','B','C');
        DECLARE inPaymentStatus enum('O','P','C');
        DECLARE inEndPrice decimal(10,2);
        DECLARE inBookingID integer;
		
		DECLARE GuestExists CONDITION FOR SQLState '45000';


        SET inDateBooking   = CURDATE();
        SET inAddrID        = (SELECT fn_IsExistingAddress(inStreet, inHnumber, inZipCode, inCity, inState));
		SET inPaymentStatus = 'O';
		SET inStatus = 'R';


        /*Prüfen ob die Adresse schon vorhanden ist*/
        IF inAddrID = 0    
        THEN
            INSERT INTO ADDR    (Street,    Hnumber,    ZipCode,    City,   State)
            VALUES              (inStreet,  inHnumber,  inZipCode,  inCity, inState);

            
            SET inAddrID = (SELECT AddrID FROM ADDR WHERE Street = inStreet AND Hnumber = inHnumber AND ZipCode = inZipCode AND City = inCity AND State = inState);
        END IF;

        /*Anlegen Gast*/
		
		IF fn_GetGuestID(inAddrID, inFirstName, inLastName, inDateOfBirth, inMail) is not null /*Fehlerbehandlung falls Gast bereits vorhanden*/
			THEN SIGNAL GuestExists
			SET MESSAGE_TEXT = 'Der eingegebene Gast existiert bereits!';
		ELSE
			INSERT INTO GUEST (AddrID, FirstName, LastName, DateOfBirth, Mail)
			VALUE             (inAddrID, inFirstName, inLastName, inDateOfBirth, inMail);
		END IF;

        SET inGuestID = fn_GetGuestID(inAddrID, inFirstName, inLastName, inDateOfBirth, inMail);

        /*Berechnung Aufschlag*/

        SET inAreaID = fn_GetAreaIDFromRental(inRentalID);                      
        SET inSeasonID = fn_GetSeasonIDFromPeriod(inStartDateRent); 
		SET inPercent = fn_GetSurchargePercentFromSeasonAndAreaID(inAreaID, inSeasonID);
		
		IF (inNumberOfVisitors >= 10) THEN
			SET inPercent = inPercent - 10;
		END IF;

        /*Aufschlag Anlegen*/

        INSERT INTO SURCHARGE (Percent, SeasonID, AreaID, NumberOfVisitors)
        VALUES (inPercent, inSeasonID, inAreaID, inNumberOfVisitors);

        SET inSurchargeID = (SELECT SurchargeID FROM SURCHARGE WHERE Percent = inPercent AND SeasonID = inSeasonID AND AreaID = inAreaID AND NumberOfVisitors = inNumberOfVisitors);
        
        /*Anlegen der Buchung*/

        INSERT INTO BOOKING (DateBooking, StartDateRent, ENDDateRent, PaymentStatus, GuestID)
        VALUES (inDateBooking, inStartDateRent, inEndDateRent, inPaymentStatus, inGuestID);

        SET inBookingID = (SELECT MAX(BookingID) FROM BOOKING);


        /*Anlegen der Buchungsdetails*/

        SET inEndPrice  = fn_CalculateEndPrice(inRentalID, inNumberOfVisitors, inStartDateRent, inEndDateRent); 

        INSERT INTO BOOKINGDETAIL (BookingID, RentalID, SurchargeID, ENDPrice, Status)
        VALUES (inBookingID, inRentalID, inSurchargeID, inEndPrice, inStatus);

	END $$
DELIMITER ;




/*------------------------------fn_GetAreaIDFromRental---------------------------*/
/*
Fuktionalität:  Dieser Funktion wird die RentalID übergeben und man erhält als Rückgabewert die AreaID.
Verfasser:      Max Schelenz
*/

DELIMITER $$
create or replace function fn_GetAreaIDFromRental(inRentalID int)

RETURNS integer

	BEGIN

		RETURN(SELECT AreaID
		FROM RENTAL
		WHERE RentalID = inRentalID);

	END $$
DELIMITER ;




/------------------------------fn_GetSeasonIDFromPeriod---------------------------/
/*
Fuktionalität:  Dieser Prozedur wird der Buchungsbeginn übergeben und man erhält als Rückgabewert die Season 
(StartDateRent ist hier das entscheidende Kriterium, welcher Season die Buchung zugeordnet wird).
Verfasser:      Max Schelenz

10 Offseason restlicher Zeitraum
20 Summer 15.06-10.09
30 Winter 01.12-15.04

*/

DELIMITER $$
create or replace function fn_GetSeasonIDFromPeriod(inStartDateRent date)

RETURNS integer
	
	BEGIN
	
		DECLARE Offseason   integer;
		DECLARE Summer      integer;
		DECLARE Winter      integer;
		DECLARE OutSeasonID integer;
		DECLARE Monat   integer;
		DECLARE Tag integer;

		SET Offseason = 10;
		SET Summer = 20;
		SET Winter = 30;
	
		SET Monat = (SELECT MONTH(inStartDateRent));
		SET Tag = (SELECT DAY(inStartDateRent));

		SET OutSeasonID = Offseason;

		IF (Monat = 6 AND Tag >= 15) OR (Monat = 7) OR (Monat = 8) OR (Monat = 9 AND Tag <= 10)
			THEN SET OutSeasonID = Summer;

			ELSEIF (Monat = 12 AND Tag >= 1) OR (Monat = 1) OR (Monat = 2) OR (Monat = 3) OR (Monat = 4 AND Tag <= 15)
			THEN SET OutSeasonID = Winter;
		
		END IF;
		
		RETURN OutSeasonID;
	
	END $$
DELIMITER ;




/*------------------------------fn_CheckPaymentStatus---------------------------*/
/*
Fuktionalität:  Diese Funktion erhält als Eingabewert die BookingID und gibt den dazu gehörigen Zahlungsstatus aus.
Verfasser:      Max Schelenz
*/

DELIMITER $$
create or replace function fn_CheckPaymentStatus(inBookingID int)

RETURNS enum('O','P','C')

	BEGIN

		RETURN (SELECT PaymentStatus
        FROM BOOKING
        WHERE BookingID = inBookingID);

	END $$
DELIMITER ;




/*------------------------------fn_GetGuestID---------------------------*/
/*
Fuktionalität:  Diese Funktion erhält als Eingabewerte die AddrID und die persönlichen Kundendaten und gibt die zugehörige GuestID zurück.
Verfasser:      Max Schelenz
*/

DELIMITER $$
create or replace function fn_GetGuestID(inAddrID int, inFirstName varchar(30), inLastName varchar(50), inDateOfBirth date, inMail varchar(200))

RETURNS int

	BEGIN

		RETURN (SELECT GuestID
        FROM GUEST
        WHERE AddrID = inAddrID AND FirstName = inFirstName AND LastName = inLastName AND DateOfBirth = inDateOfBirth AND Mail = inMail);

	END $$
DELIMITER ;




/*------------------------------p_ShowBooking---------------------------*/
/*
Fuktionalität:  Diese Prozedur erhält als Eingabewert die BookingID und gibt die zugehörigen Buchungsdaten zurück.
Verfasser:      Max Schelenz
*/

DELIMITER $$
create or replace procedure p_ShowBooking(IN inBookingID int)

	BEGIN

		SELECT StartDateRent, EndDateRent, PaymentStatus, GuestID
        FROM BOOKING
        WHERE BookingID = inBookingID;

	END $$
DELIMITER ;




/*------------------------------fn_CalculateEndPrice---------------------------*/
/*
Fuktionalität:  Diese Prozedur erhält als Eingabewert die RentalID, AddrID, SeasonID und NumberOfVisitors und gibt den berechneten Endpreis zurück.
Verfasser:      Max Schelenz
*/

DELIMITER $$
create or replace function fn_CalculateEndPrice    (
                                            /*Benötigte Faktoren der Berechnung*/
                                              inRentalID int
                                            , inNumberOfVisitors int
                                            , inStartDateRent date
                                            , inEndDateRent date
                                            )
    RETURNS int
    
    BEGIN

        DECLARE OutEndPrice decimal(10,2);
        DECLARE BasicPrice int;
        DECLARE SurchargePercent decimal(5,2);
        DECLARE NumberOfDays int;
        DECLARE AreaID int;
        DECLARE SeasonID int;

        SET BasicPrice = (SELECT RENTAL.BasicPrice
        FROM RENTAL
        WHERE RENTAL.RentalID = inRentalID);                /*Apartmentpreis*/

        SET AreaID = (
            SELECT RENTAL.AreaID
            FROM RENTAL
            WHERE RENTAL.RentalID = inRentalID
        );
        
        SET SeasonID = fn_GetSeasonIDFromPeriod(inStartDateRent);

        SET SurchargePercent = fn_GetSurchargePercentFromSeasonAndAreaID(AreaID, SeasonID);
        
		SET NumberOfDays = DATEDIFF(inEndDateRent, inStartDateRent);             /*Buchungszeitraum in Tagen*/

        SET OutEndPrice = (BasicPrice+(5*(inNumberOfVisitors-1))) * NumberOfDays * (1+(SurchargePercent/100));    /*Preisberechnung*/

        RETURN OutEndPrice;

    END $$
DELIMITER ;




/*------------------------------fn_GetSurchargePercentFromSeasonAndAreaID---------------------------*/
/*
Fuktionalität:  Diese Funktion erhält als Eingabewert die SeasonID und AreaID und gibt die SURCHARGE.Percent zurück.
Verfasser:      Max Schelenz
*/

DELIMITER $$
create or replace function fn_GetSurchargePercentFromSeasonAndAreaID   (                                            
                                              inAreaID int
											, inSeasonID int
                                            )
RETURNS decimal(5,2)
  
	BEGIN
        
		DECLARE OutSurchargePercent decimal(5,2);

        IF (inAreaID = 10 AND inSeasonID = 20)
		THEN SET OutSurchargePercent = 15;									/*Sommersaison am Meer*/
			ELSEIF (inAreaID = 10 AND inSeasonID = 30)
			THEN SET OutSurchargePercent = -5;								/*Wintersaison am Meer*/
				ELSEIF (inAreaID = 10 AND inSeasonID = 10)
				THEN SET OutSurchargePercent = 15;							/*Offseason am Meer*/
					
			ELSEIF (inAreaID = 20 AND inSeasonID = 20)
			THEN SET OutSurchargePercent = 10;								/*Sommersaison in den Bergen*/	
				ELSEIF (inAreaID = 20 AND inSeasonID = 30)
				THEN SET OutSurchargePercent = 20;							/*Wintersaison in den Bergen*/
					ELSEIF (inAreaID = 20 AND inSeasonID = 10)
					THEN SET OutSurchargePercent = 15;						/*Offseason in den Bergen*/
					
			ELSEIF (inAreaID = 30 AND inSeasonID = 20)
			THEN SET OutSurchargePercent = 10;								/*Sommersaison in der Stadt*/	
				ELSEIF (inAreaID = 20 AND inSeasonID = 30)
				THEN SET OutSurchargePercent = 10;							/*Wintersaison in der Stadt*/
					ELSEIF (inAreaID = 20 AND inSeasonID = 10)
					THEN SET OutSurchargePercent = 10;	
				
	
		END IF;
		
        RETURN OutSurchargePercent;
		
	END $$
DELIMITER ;



/*-----------------------------------------------------------------------------*/
/*--------------- Testfälle für Prozeduren und Funktionen ---------------------*/
/*-----------------------------------------------------------------------------*/

/*Da bereits im Buchungsvorgang online alle Eingabefehler und 
Komplikationen mit dem Buchungszeitraum -> nicht anwählbare Zeiträume im Webkalender wenn Rental Status nicht
auf Completed ist, nicht anwählbare Rentals bei zu hoher Gästeanzahl, usw. ausgemerzt werden,
ist in diesem Fall keine genauere Fehlerbetrachtung von Nöten. Alle möglicherweise
auftretenden Datenbankkomplikationen werden in den Prozeduren und Funktionen
an Bedingungen geknüpft und überprüft. */

/*----------------/T30.1.1/ Buchung erstellen-------------------------------------*/
/*
Folgende Buchung ist online eingegangen und soll angelegt werden: 

    Name: Sippi Klappstuhl
    Geburtsdatum: 25.08.1993
    Adresse: Am Hilfsgraben 3, 10115 Berlin 
    E-Mail: sippi.klappstuhl93@guest.com
    Gebuchtes Objekt: RentalID=30, HouseID=10 
    Buchungszeitraum: 30.07-28.09.2023
	Anzahl Gäste (insgesamt): 8
*/

call p_SetBooking
(
	"Am Hilfsgraben", 3, 10115, "Berlin", "BE", "Sippi", "Klappstuhl", "1993-08-25",
	"sippi.klappstuhl93@guest.com", "2023-07-30", "2023-09-28", 30, 8
);



/*----------------/T30.1.1.2/fn_GetGuestID-----------------------------------*/
SELECT fn_GetGuestID(65, "Robert", "Ulrich", "2001-04-15", "Robert.Ulrich@guest.de"); --> 7


/*----------------/T30.1.1.3/fn_GetAreaIDFromRental--------------------------*/
SELECT fn_GetAreaIDFromRental(30); --> 20


/*----------------/T30.1.1.4/fn_GetSeasonIDFromPeriod------------------------*/
SELECT fn_GetSeasonIDFromPeriod("2023-07-30"); --> 20


/*----------------/T30.1.1.5/fn_CalculateEndPrice------------------------*/
SELECT fn_CalculateEndPrice(30, 8, "2023-07-30", "2023-09-28"); --> 6270


/*----------------/T30.1.3/p_ShowBooking------------------------*/
call p_ShowBooking(8); --> StartDateRent: 2020-21-31, EndDateRent: 2021-01-14, PaymentStatus: C, GuestID: 8


/*----------------/T40.1.1/fn_CheckPaymentStatus------------------------*/
SELECT fn_CheckPaymentStatus(7); --> P

