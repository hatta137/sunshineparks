/*------------------------------fn_GetResortAddrID---------------------------*/
/*
Fuktionalität:  Dieser Funktion wird ein Resortname übergeben und gibt darauf die AddrID wieder zurück.
Beispiel:       SELECT fn_GetResortAddrID('Erfurt') --> 17
Verfasser:      Hendrik Lendeckel
*/

DELIMITER $$
create or replace function fn_GetResortAddrID (inValue char(30))
returns integer
begin
	declare outAddrID integer;


    
    set outAddrID = (   select ADDR.AddrID 
                        from ADDR 
                        join RESORT on ADDR.AddrID = RESORT.AddrID
                        where RESORT.Name = inValue);

    
	return outAddrID;   
END $$
DELIMITER ;


/*------------------------------fn_GetRentalAddrID---------------------------*/
/*
Fuktionalität:  Dieser Funktion wird eine RentalID übergeben und gibt darauf die AddrID wieder zurück.
Beispiel:       SELECT fn_GetResortAddrID(10) --> 77
Verfasser:      Hendrik Lendeckel
*/


DELIMITER $$
create or replace function fn_GetRentalAddrID (inValue integer)
returns integer
begin
	declare outAddrID integer;


    
    set outAddrID = (   select ADDR.AddrID 
                        from ADDR 
                        join RENTAL on ADDR.AddrID = RENTAL.AddrID
                        where RENTAL.RentalID = inValue);

    
	return outAddrID;   
END $$
DELIMITER ;


/*------------------------------fn_IsExistingAddress-------------------------*/
/*
Fuktionalität:  Dieser Funktion wird eine Adresse der Form Straße, Hausnummer, Postleitzahl, Stadt übergeben. Sie prüft, ob diese Adresse bereits existiert.
                Falls ja, wird die AddrID zurückgegeben, falls nein 0.

Verfasser:      Hendrik Lendeckel
*/


DELIMITER $$
create or replace function fn_IsExistingAddress (inStreet varchar(50), inHnumber integer, inZipCode char(5), inCity varchar(50), inState varchar (20))
returns integer
begin
	declare outE integer;

    SET outE = 0;
    
        

        IF              (SELECT AddrID FROM ADDR WHERE Street = inStreet AND Hnumber = inHnumber AND ZipCode = inZipCode AND City = inCity AND State = inState) IS NOT NULL
        THEN SET outE = (SELECT AddrID FROM ADDR WHERE Street = inStreet AND Hnumber = inHnumber AND ZipCode = inZipCode AND City = inCity AND State = inState);
        END IF;

    
	return outE;   
END $$
DELIMITER ;

/*--TESTFALL-----/T10.1.1.2/ fn_IsExistingAddress-----------------------------*/
SELECT fn_IsExistingAddress("Dünenstraße", 11, "17419", "Aalbeck", "MVP");  --> 1 (AddrID)
SELECT fn_IsExistingAddress('Am Wasser', 3, '37308', 'Lutter', 'TH');       --> 0





/*------------------------------fn_GetAreaID-------------------------*/
/*
Fuktionalität:  Dieser Funktion wird ein Resort-Name übergeben. Zurückgegeben wird die passende AreaID.

                
Verfasser:      Hendrik Lendeckel
*/


DELIMITER $$
create or replace function fn_GetAreaID (inResortName varchar(20))
returns integer
begin
	declare outAreaID integer;
    
    IF inResortName LIKE "%erfurt%"         THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'C'); END IF;
    IF inResortName LIKE "%oberhof%"        THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'M'); END IF;
    IF inResortName LIKE "%usedom%"         THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'O'); END IF;
    IF inResortName LIKE "%berchtesgaden%"  THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'M'); END IF;

    
	return outAreaID;   
END $$
DELIMITER ;

/*--TESTFALL---/T10.1.1.2/ fn_GetAreaID--------------------------------*/
SELECT fn_GetAreaID("Erfurt"); --> 30


/*------------------------------fn_GetResortID-------------------------*/
/*
Fuktionalität:  Dieser Funktion wird ein Resort-Name übergeben. Zurückgegeben wird die passende ResortID.

                
Verfasser:      Hendrik Lendeckel
*/


DELIMITER $$
create or replace function fn_GetResortID (inResortName varchar(20))
returns integer
begin
	declare outResortID integer;
    
    IF inResortName LIKE "%usedom%"             THEN SET outResortID = (SELECT ResortID FROM RESORT WHERE Name = "Usedom");         END IF;
    IF inResortName LIKE "%erfurt%"             THEN SET outResortID = (SELECT ResortID FROM RESORT WHERE Name = "Erfurt");         END IF;
    IF inResortName LIKE "%berchtesgaden%"      THEN SET outResortID = (SELECT ResortID FROM RESORT WHERE Name = "Berchtesgaden");  END IF;
    IF inResortName LIKE "%oberhof%"            THEN SET outResortID = (SELECT ResortID FROM RESORT WHERE Name = "Oberhof");        END IF;

    
	return outResortID;   
END $$
DELIMITER ;

/*--TESTFALL----/T10.1.1.1/ fn_GetResortID------------------------------*/
SELECT fn_GetResortID("Erfurt"); --> 10



/*----------------------F10.2.1--fn_GetRentalStatus()--------------------*/
/*
Fuktionalität:  Dieser Funktion wird eine RentalID übergeben. Sie liefert den aktuellen Status des Objektes zurück.
                
Verfasser:      Hendrik Lendeckel
*/

DELIMITER $$
create or replace function fn_GetRentalStatus (inRentalID integer)
returns enum('R','N','C','D','M', 'B')
begin
	declare outRentalStatus enum('R','N','C','D','M', 'B');
  
    SET outRentalStatus = (SELECT Status FROM RENTAL WHERE RentalID = inRentalID);
    
	return outRentalStatus;   
END $$
DELIMITER ;

/*--TESTFALL----/T10.2.1/ fn_GetRentalStatus------------------------------*/
SELECT fn_GetRentalStatus(2); --> C
SELECT fn_GetRentalStatus(2); --> NULL














/*
-------------------------------------------------------------------------------
--/F10.1.1  Prozedur p_NewRental() zum anlegen eines neuen Objektes (Rental)---
-------------------------------------------------------------------------------

Verfasser: Hendrik Lendeckel
*/

DELIMITER $$
create or replace procedure p_NewRental( 	

                            /* --------------------------------INFOS zum RENTAL ----------------------------------------------------------*/
                            IN inMaxVisitor int,          IN inBedroom int,                             IN inBathroom int,       IN inSqrMeter int, 
                            IN inStatus enum('R','N','C','D','M','B'),    IN isAppartment boolean,      IN inResortName varchar(20), 
                            /* --------------------------------INFOS APPARTMENT ----------------------------------------------------------*/
							IN inBalcony enum('Y','N'),    IN inRoomnumber int,                               IN inFloor int,
                            /* -------------------------------------INFOS HOUSE ----------------------------------------------------------*/
							IN inTerrace enum('Y','N'),    IN inKitchen int,
                            /* -------------------------------------INFOS ZUR ADRESSE-----------------------------------------------------*/          
                            IN inStreet varchar(50), IN inHnumber int, IN inZipCode char(5), IN inCity varchar(50), IN inState varchar(50))
	begin

        
        /* Variablendeklaration */
        declare inRentalID      integer;
        declare inResortID      integer;
        declare inAreaID        integer;
        declare inAddrID        integer;
        declare inBasicPrice    decimal(7,2);

        /* Fehlerbehandlung bei Falscheingaben:*/
        declare invalidValues CONDITION FOR SQLSTATE '45000';

        IF inSqrMeter <= 10 THEN      
            SIGNAL invalidValues
            SET MESSAGE_TEXT = 'Fehler E.2 Bitte eine realistische Quadratmeterzahl waehlen!';
        END IF; 

        IF isAppartment = false AND inBedroom < 4 THEN      
            SIGNAL invalidValues
            SET MESSAGE_TEXT = 'Fehler E.3 Anzahl der Schlafzimmer bei Ferienhausern muss groeßer 4 sein!';
        END IF; 
        
        IF isAppartment = false AND inMaxVisitor < 5 OR inMaxVisitor > 16 THEN      
            SIGNAL invalidValues
            SET MESSAGE_TEXT = 'Fehler E.4 Ein Ferienhaus hat eine maximale Gaesteanzahl von 5 - 16!';
        END IF; 

        IF (inMaxVisitor / inBedroom) > 2 THEN      
            SIGNAL invalidValues
            SET MESSAGE_TEXT = 'Fehler E.5 Maximale Anzahl der Gaeste passt nicht zu Bettenzahl!';
        END IF; 

        IF isAppartment = true AND inMaxVisitor > 6 THEN      
            SIGNAL invalidValues
            SET MESSAGE_TEXT = 'Fehler E.6 Maximale Gaeste bei Ferienwohnung sind 6!';
        END IF; 

        IF isAppartment = true AND inBedroom > 6 THEN      
            SIGNAL invalidValues
            SET MESSAGE_TEXT = 'Fehler E.7 Maximale Anzahl der Schlafzimmer in Ferienwohnungen sind 6!';
        END IF;



        /* Berechnung der zusätzlichen Informationen */
        SET inResortID  = (SELECT fn_GetResortID(inResortName));                                                /* F10.1.1.1 fn_GetResortID */
        SET inAreaID    = (SELECT fn_GetAreaID(inResortName));                                                  /* F10.1.1.2 fn_GetAreaID */
        SET inAddrID    = (SELECT fn_IsExistingAddress(inStreet, inHnumber, inZipCode, inCity, inState));       /* F10.1.1.3 fn_IsExistingAddress */

        IF inAddrID = 0    /* Nur wenn Adresse nicht vorhanden, wird sie hier angelegt*/
        THEN
            INSERT INTO ADDR    (Street,    Hnumber,    ZipCode,    City,   State)
            VALUES              (inStreet,  inHnumber,  inZipCode,  inCity, inState);

            /*SET inAddrID = (SELECT MAX(AddrID) FROM ADDR); */ /*Gibt die höchste ID zurück*/
            SET inAddrID = (SELECT AddrID FROM ADDR WHERE Street = inStreet AND Hnumber = inHnumber AND ZipCode = inZipCode AND City = inCity AND State = inState);
        END IF;

        /* Setzen der jeweiligen Grundpreise */
        IF isAppartment = true THEN SET inBasicPrice = 30;   END IF;
        IF isAppartment = false THEN SET inBasicPrice = 60;  END IF;

        /*Eintragen der Informationen in die Tabelle RENTAL*/
		INSERT INTO RENTAL  (MaxVisitor,    Bedroom,    Bathroom,   SqrMeter,   BasicPrice,   Status,     AreaID,     ResortID,   AddrID)
		VALUES		        (inMaxVisitor,  inBedroom,  inBathroom, inSqrMeter, inBasicPrice, inStatus,   inAreaID,   inResortID, inAddrID);
        
		

        SET inRentalID = (SELECT RentalID FROM RENTAL WHERE AddrID = inAddrID);
        /* SET inRentalID = (SELECT MAX(RentalID) FROM RENTAL); *//*Gibt die höchste ID zurück*/
		

        /* Eintragen der Informationen in die Tabelle APPARTMENT (sofern das Objekt eine Ferienwohnung ist)*/
		IF isAppartment = true
		THEN 	
                SET inTerrace = 'N';
				SET inKitchen = 1;
				INSERT INTO APPARTMENT  (RentalID,      Balcony,    Roomnumber,     Floor) 
				VALUES		            (inRentalID,    inBalcony,  inRoomnumber,   inFloor);
		END IF;

        /* Eintragen der Informationen in die Tabelle HOUSE (sofern das Objekt ein Ferienhaus bzw. keine Ferienwohnung ist)*/
		IF isAppartment = false
		THEN 	
                SET inBalcony = 'N';
				SET inRoomnumber = 0;
				SET inFloor = 0;
				INSERT INTO HOUSE   (RentalID,      Terrace,    Kitchen)
				VALUES		        (inRentalID,    inTerrace,  inKitchen);
		END IF;


		
	end $$
DELIMITER ;

/*--TESTFALL------/T10.1.1/ Objekt anlegen-------------------------------------*/
/*
- Ferienhaus mit Terrasse (Bestandsobjekt soll aufgenommen werden) 
- Maximale Gäste: 12 
- Anzahl Schlafzimmer: 6 
- Anzahl Badezimmer: 3 
- Anzahl Küchen: 2 
- 260 Quadratmeter 
- Resort Usedom 
- Adresse des Objektes: Siegerstraße 9, 17413 Usedom

*/
call p_NewRental
(
    12, 6, 3, 260, 'C', false, "Usedom", 'N', 0, 0, 'Y', 3,
    "Siegerstraße", 10, 17413, "Usedom",  "MVP"           
);

/* Test der Fehlerbehandlungen */
--> call p_NewRental(4, 3, 1, 9,  'C', true,  "Erfurt", 'Y', 12, 1, 'N', 0, "Am wasser", 6, 37308, "Erfurt", "TH"); --> Fehler E2
--> call p_NewRental(4, 3, 1, 55, 'C', false, "Erfurt", 'Y', 12, 1, 'N', 0, "Am wasser", 6, 37308, "Erfurt", "TH"); --> Fehler E3
--> call p_NewRental(4, 6, 1, 55, 'C', false, "Erfurt", 'Y', 12, 1, 'N', 0, "Am wasser", 6, 37308, "Erfurt", "TH"); --> Fehler E4
--> call p_NewRental(9, 4, 1, 55, 'C', false, "Erfurt", 'Y', 12, 1, 'N', 0, "Am wasser", 6, 37308, "Erfurt", "TH"); --> Fehler E.5
--> call p_NewRental(7, 4, 1, 55, 'C', true,  "Erfurt", 'Y', 12, 1, 'N', 0, "Am wasser", 6, 37308, "Erfurt", "TH"); --> Fehler E.6
--> call p_NewRental(6, 7, 1, 55, 'C', true,  "Erfurt", 'Y', 12, 1, 'N', 0, "Am wasser", 6, 37308, "Erfurt", "TH"); --> Fehler E.7

/*-----------------------------------------------------------------------------*/




/*
-------------------------------------------------------------------------------
--------Prozedur p_NewBuilding() zum anlegen eine Neubaus ---------------------
-------------------------------------------------------------------------------
*/


DELIMITER $$
create or replace procedure p_NewBuilding   (
                                            /* --------------------------------INFOS zum RENTAL ----------------------------------------------------------*/
                                            IN inMaxVisitor int,      IN inBedroom int,           IN inBathroom int,        IN inSqrMeter int, 
                                            IN isAppartment boolean,  IN inResortName varchar(20), 
                                            /* --------------------------------INFOS APPARTMENT ----------------------------------------------------------*/
							                IN inBalcony enum('Y','N'),    IN inRoomnumber int,                           IN inFloor int,
                                            /* -------------------------------------INFOS HOUSE ----------------------------------------------------------*/
							                IN inTerrace enum('Y','N'),    IN inKitchen int,
                                            /* -------------------------------------INFOS ZUR ADRESSE-----------------------------------------------------*/          
                                            IN inStreet varchar(50), IN inHnumber int, IN inZipCode char(5), IN inCity varchar(50), IN inState varchar(50),
                                            /* --------------------------------INFOS zum Neubau --> STRUCCHANGE-------------------------------------------*/
                                            IN inStartDate date, IN inPlannedEndDate date, IN inDescription varchar(200), IN inPlannedCosts decimal(10,2)
                                            )





    begin

        declare inStatus enum('R','N','C','D','M','B');
        declare inRentalID integer;
        

        SET inStatus = 'N'; /*Status eines angelegten Neubaus ist immer N */

        call p_NewRental(   inMaxVisitor,   inBedroom,      inBathroom,       inSqrMeter, 
                            inStatus,       isAppartment,   inResortName,
                            inBalcony,      inRoomnumber,   inFloor,          inTerrace,        inKitchen,
                            inStreet,       inHnumber,      inZipCode,        inCity,           inState);

        SET inRentalID = (SELECT RentalID FROM RENTAL JOIN ADDR on ADDR.AddrID = RENTAL.AddrID WHERE ADDR.Street = inStreet AND ADDR.Hnumber = inHnumber AND ADDR.ZipCode = inZipCode AND ADDR.City = inCity AND ADDR.State = inState);
        /*--SET inRentalID = (SELECT MAX(RentalID) FROM RENTAL);*/

        INSERT INTO STRUCCHANGE (RentalID,      StartDate,      PlannedEndDate,     Description,    PlannedCosts)
        VALUES                  (inRentalID,    inStartDate,    inPlannedEndDate,   inDescription,  inPlannedCosts);

        

    end $$
DELIMITER ;









/*----------------/T20.2.1/ p_NewBuilding--------------------------------------*/
/*
Informationen zum Objekt: 

- Ferienhaus mit Terrasse  
- Maximale Gäste: 16 
- Anzahl Schlafzimmer: 8 
- Anzahl Badezimmer: 4 
- Anzahl Küchen: 4 
- 330 Quadratmeter 
- Resort Oberhof 
- Adresse des Objektes: Blumenallee 9, 98559 Oberhof 

Informationen zum Neubau: 

- Startdatum des Neubaus: 01.09.2022 
- Geplantes Enddatum: 01.06.2023 
- Beschreibung: “Neubau Prestige Objekt Oberhof” 
- Geplante Kosten laut Kostenvoranschlag: 500000,00€ 

*/
call p_NewBuilding
(
    12, 8, 4, 330,
    false, "Oberhof",
    'N', 0, 0,
    'Y', 4,
    "Blumenallee", 9, "98559", "Oberhof", "TH",
    "2022-09-01", "2023-06-01", "Neubau Prestige Objekt Oberhof", 500000.00
);



/*
-------------------------------------------------------------------------------
--------Prozedur p_CompleteNewBuilding() Abschließen eines Neubaus ------------
-------------------------------------------------------------------------------
*/

DELIMITER $$
create or replace procedure p_CompleteNewBuilding(inRentalID int, inEndDate date, inEndCosts decimal(10,2))

    begin
        UPDATE STRUCCHANGE 
        SET EndDate = inEndDate, EndCosts = inEndCosts
        WHERE (RentalID = inRentalID);

        UPDATE RENTAL
        SET Status = 'C'
        WHERE (RentalID = inRentalID);


    end $$
DELIMITER ;

/*-----TESTFALL T20.2.4  p_CompleteNewBuilding--------------------------------*/

call p_CompleteNewBuilding
(
    34, '2022-07-12', 456789.99
);