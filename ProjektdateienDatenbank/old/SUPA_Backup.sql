-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 17. Jul 2022 um 14:20
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `SUPA`
--

DELIMITER $$
--
-- Prozeduren
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_ChangeObjektstatus` (`inRentalID` INT, `NewObjStatus` VARCHAR(1))   begin
        update RENTAL
        set  Status = NewObjStatus
        where RentalID = inRentalID;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_changeRenovation_CraftServID` (`inChangeID` INT, `newCraftServID` INT)   begin
		update STRUCCHANGE
		set CraftServID = newCraftServID
		where ChangeID = inChangeID;

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_changeRenovation_Description` (`inChangeID` INT, `newDescription` VARCHAR(200))   begin
		update STRUCCHANGE
		set Description = newDescription
		where ChangeID = inChangeID;

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_changeRenovation_EndCosts` (`inChangeID` INT, `newEndCosts` INT)   begin
		update STRUCCHANGE
		set EndCosts = newEndCosts
		where ChangeID = inChangeID;

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_changeRenovation_EndDate` (`inChangeID` INT, `newEndDate` DATE)   begin
		update STRUCCHANGE
		set EndDate = newEndDate
		where ChangeID = inChangeID;

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_changeRenovation_PlannedCosts` (`inChangeID` INT, `newPlannedCosts` INT)   begin
		update STRUCCHANGE
		set PlannedCosts = newPlannedCosts
		where ChangeID = inChangeID;

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_changeRenovation_PlannedEndDate` (`inChangeID` INT, `newPlannedEndDate` DATE)   begin
		update STRUCCHANGE
		set PlannedEndDate = newPlannedEndDate
		where ChangeID = inChangeID;

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_changeRenovation_Rental` (`inChangeID` INT, `newRentalID` INT)   begin
		update STRUCCHANGE
		set RentalID = newRentalID
		where ChangeID = inChangeID;

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_changeRenovation_StartDate` (`inChangeID` INT, `newStarDate` DATE)   begin
		update STRUCCHANGE
		set StarDate = newStarDate
		where ChangeID = inChangeID;

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_CompleteNewBuilding` (`inRentalID` INT, `inEndDate` DATE, `inEndCosts` DECIMAL(10,2))   begin
        UPDATE STRUCCHANGE 
        SET EndDate = inEndDate, EndCosts = inEndCosts
        WHERE (RentalID = inRentalID);

        UPDATE RENTAL
        SET Status = 'C'
        WHERE (RentalID = inRentalID);


    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_FinishMaintenance` (`inMaintenanceID` INT)   begin
        declare inRentalID int;
        select RentalID into inRentalID from MAINTENANCE where MaintenanceID = inMaintenanceID;
        call p_ChangeObjektstatus(inRentalID, 'C');
        update MAINTENANCE 
        set active ='F'
        where MaintenanceID = inMaintenanceID;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_GetFreeMaintenanceEmp` (IN `inRentalID` INT, OUT `outEmpID` INT, OUT `outDate` DATE)   begin
        declare vResortID int;
        declare vDate date;
        declare vEmpID int;
        declare vRentalID int;
        declare vAuftragStatus varchar(1);
        declare vDone int DEFAULT FALSE;

		declare vEmpCur CURSOR 
		FOR
		SELECT EmpID FROM EMP where Job = 'Instandhaltungskraft' and ResortID = vResortID;
		
		declare CONTINUE HANDLER 
		FOR 
		NOT FOUND set vDone =TRUE;

        set vDate = CURRENT_DATE;
        set vResortID = fn_GetRentalResortID(inRentalID);

        OPEN vEmpCur;
		
		FETCH vEmpCur INTO vEmpID;   
	
		checkEmpFree: LOOP
            
            set vAuftragStatus = (select Active from MAINTENANCE
            where EmpID = vEmpID and MaintenanceDate = vDate);

            if (vAuftragStatus != 'O' and (select MaintenanceID from MAINTENANCE where EmpID = vEmpID and MaintenanceDate = vDate) is null)
            or (select MaintenanceID from MAINTENANCE where EmpID = vEmpID and MaintenanceDate = vDate) is null
             then
                set outEmpID = vEmpID;
                set outDate = vDate;
                LEAVE checkEmpFree;
            end if;
	
				IF vDone
					THEN SET vDate = ADDDATE(vDate, 1);
                    close vEmpCur;
                    open vEmpCur;
				END IF;		
            FETCH  vEmpCur  into vEmpID;	
		END LOOP;

		CLOSE vEmpCur;		

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_getReinigungen` (`inEmpID` INT)   BEGIN

if (select CleaningID from CLEANING
where EmpID = inEmpid order by CleaningID limit 1) is NULL
then signal sqlstate '45000' set Message_text = 'Keine Reinigungen für diesen Mitarbeiter vorhanden!';
end if;

select Street, Hnumber, ZipCode, City, starttime, cleaningdate from ADDR join RENTAL on ADDR.AddrID = RENTAL.AddrID join CLEANING on CLEANING.RentalID = RENTAL.RentalID
where CLEANING.EmpID = inEmpid;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_NewBuilding` (IN `inMaxVisitor` INT, IN `inBedroom` INT, IN `inBathroom` INT, IN `inSqrMeter` INT, IN `isAppartment` BOOLEAN, IN `inResortName` VARCHAR(20), IN `inBalcony` ENUM('Y','N'), IN `inRoomnumber` INT, IN `inFloor` INT, IN `inTerrace` ENUM('Y','N'), IN `inKitchen` INT, IN `inStreet` VARCHAR(50), IN `inHnumber` INT, IN `inZipCode` CHAR(5), IN `inCity` VARCHAR(50), IN `inState` VARCHAR(50), IN `inStartDate` DATE, IN `inPlannedEndDate` DATE, IN `inDescription` VARCHAR(200), IN `inPlannedCosts` DECIMAL(10,2))   begin

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

        

    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_NewMaintenance` (IN `inRentalID` INT, IN `inDescription` VARCHAR(200))   begin
        declare vEmpID int;
        declare vDate date;
        declare noRental CONDITION for SQLSTATE '45000';
        if (select fn_IsExistingRental(inRentalID)) = 1 then
            call p_GetFreeMaintenanceEmp(inRentalID, vEmpID, vDate);
            insert into MAINTENANCE(RentalID, Description, MaintenanceDate, EmpID, active)
            values(inRentalID,inDescription,vDate, vEmpID, 'O');
            call p_ChangeObjektstatus(inRentalID,'M');
        else
            SIGNAL noRental
            set MESSAGE_TEXT = 'Gibt kein Rental mit der ID, bitte neu eingeben!';
        end if;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_NewRenovation` (IN `inRentalID` INT, IN `inStartDate` DATE, IN `inPlannedEndDate` DATE, IN `inDescription` VARCHAR(200), IN `inPlannedCosts` INT, IN `inCraftServID` INT)   begin
    declare inChangeID integer;
    declare StrucchangeExists CONDITION for SQLSTATE '45000';

     if fn_getChangeID(inRentalID, inStartDate, inPlannedEndDate, inPlannedCosts, inCraftServID)= -1
		THEN SIGNAL StrucchangeExists 
		SET MESSAGE_TEXT = 'Die eingegebene Renovierung wurde bereits erfasst';
    Else

    insert into STRUCCHANGE (RentalID, StartDate, PlannedEndDate, Description, PlannedCosts, CraftServID)
    values (inRentalID, inStartDate, inPlannedEndDate, inDescription, inPlannedCosts, inCraftServID);
	end if;

    SET inChangeID = (SELECT MAX(ChangeID) FROM STRUCCHANGE);
	
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_NewRental` (IN `inMaxVisitor` INT, IN `inBedroom` INT, IN `inBathroom` INT, IN `inSqrMeter` INT, IN `inStatus` ENUM('R','N','C','D','M','B'), IN `isAppartment` BOOLEAN, IN `inResortName` VARCHAR(20), IN `inBalcony` ENUM('Y','N'), IN `inRoomnumber` INT, IN `inFloor` INT, IN `inTerrace` ENUM('Y','N'), IN `inKitchen` INT, IN `inStreet` VARCHAR(50), IN `inHnumber` INT, IN `inZipCode` CHAR(5), IN `inCity` VARCHAR(50), IN `inState` VARCHAR(50))   begin

        
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


		
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_SetBooking` (IN `inStreet` VARCHAR(50), IN `inHnumber` INT, IN `inZipCode` CHAR(5), IN `inCity` VARCHAR(50), IN `inState` VARCHAR(50), IN `inFirstName` VARCHAR(30), IN `inLastName` VARCHAR(50), IN `inDateOfBirth` DATE, IN `inMail` VARCHAR(200), IN `inStartDateRent` DATE, IN `inEndDateRent` DATE, IN `inRentalID` INT, IN `inNumberOfVisitors` INT)   BEGIN
        
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

	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_ShowBooking` (IN `inBookingID` INT)   BEGIN

		SELECT StartDateRent, EndDateRent, PaymentStatus, GuestID
        FROM BOOKING
        WHERE BookingID = inBookingID;

	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_WriteRepairProtocol` (`inMaintenanceID` INT, `protocol` VARCHAR(200))   begin
        update MAINTENANCE
        set RepairProtocol = protocol
        where MaintenanceID = inMaintenanceID;
    end$$

--
-- Funktionen
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_CalculateEndPrice` (`inRentalID` INT, `inNumberOfVisitors` INT, `inStartDateRent` DATE, `inEndDateRent` DATE) RETURNS INT(11)  BEGIN

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

    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_CheckPaymentStatus` (`inBookingID` INT) RETURNS ENUM('O','P','C') CHARSET utf8mb4  BEGIN

		RETURN (SELECT PaymentStatus
        FROM BOOKING
        WHERE BookingID = inBookingID);

	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetAreaID` (`inResortName` VARCHAR(20)) RETURNS INT(11)  begin
	declare outAreaID integer;
    
    IF inResortName LIKE "%erfurt%"         THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'C'); END IF;
    IF inResortName LIKE "%oberhof%"        THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'M'); END IF;
    IF inResortName LIKE "%usedom%"         THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'O'); END IF;
    IF inResortName LIKE "%berchtesgaden%"  THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'M'); END IF;

    
	return outAreaID;   
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetAreaIDFromRental` (`inRentalID` INT) RETURNS INT(11)  BEGIN

		RETURN(SELECT AreaID
		FROM RENTAL
		WHERE RentalID = inRentalID);

	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetChangeID` (`inRentalID` INT, `inStartDate` DATE, `inPlannedEndDate` DATE, `inPlannedCosts` INT, `inCraftServID` INT) RETURNS INT(11)  begin
    declare OutChangeID int;
    
    if (inCraftServID = '') then
        set inCraftServID = null;
    end if;
    
    if (inCraftServID is not null) then
        set OutChangeID =  (select ChangeID 
                        from STRUCCHANGE
                        where inRentalID = RentalID
                        and inStartDate =  StartDate
                        and inPlannedEndDate = PlannedEndDate
                        and inPlannedCosts = PlannedCosts
                        and inCraftServID = CraftServID);
    else
        set OutChangeID =  (select ChangeID 
                        from STRUCCHANGE
                        where inRentalID = RentalID
                        and inStartDate =  StartDate
                        and inPlannedEndDate = PlannedEndDate
                        and inPlannedCosts = PlannedCosts
                        and inCraftServID is null);
    end if;

    return ifnull(OutChangeID,-1);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetGuestID` (`inAddrID` INT, `inFirstName` VARCHAR(30), `inLastName` VARCHAR(50), `inDateOfBirth` DATE, `inMail` VARCHAR(200)) RETURNS INT(11)  BEGIN

		RETURN (SELECT GuestID
        FROM GUEST
        WHERE AddrID = inAddrID AND FirstName = inFirstName AND LastName = inLastName AND DateOfBirth = inDateOfBirth AND Mail = inMail);

	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetRentalAddrID` (`inValue` INTEGER) RETURNS INT(11)  begin
	declare outAddrID integer;


    
    set outAddrID = (   select ADDR.AddrID 
                        from ADDR 
                        join RENTAL on ADDR.AddrID = RENTAL.AddrID
                        where RENTAL.RentalID = inValue);

    
	return outAddrID;   
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetRentalResortID` (`inRentalID` INT) RETURNS INT(11)  begin
        declare outResortID int;
        select ResortID into outResortID from RENTAL where RentalID = inRentalID;
        return outResortID;
    end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetRentalStatus` (`inRentalID` INTEGER) RETURNS ENUM('R','N','C','D','M','B') CHARSET utf8mb4  begin
	declare outRentalStatus enum('R','N','C','D','M', 'B');
  
    SET outRentalStatus = (SELECT Status FROM RENTAL WHERE RentalID = inRentalID);
    
	return outRentalStatus;   
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetResortAddrID` (`inValue` CHAR(30)) RETURNS INT(11)  begin
	declare outAddrID integer;


    
    set outAddrID = (   select ADDR.AddrID 
                        from ADDR 
                        join RESORT on ADDR.AddrID = RESORT.AddrID
                        where RESORT.Name = inValue);

    
	return outAddrID;   
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetResortID` (`inResortName` VARCHAR(20)) RETURNS INT(11)  begin
	declare outResortID integer;
    
    IF inResortName LIKE "%usedom%"             THEN SET outResortID = (SELECT ResortID FROM RESORT WHERE Name = "Usedom");         END IF;
    IF inResortName LIKE "%erfurt%"             THEN SET outResortID = (SELECT ResortID FROM RESORT WHERE Name = "Erfurt");         END IF;
    IF inResortName LIKE "%berchtesgaden%"      THEN SET outResortID = (SELECT ResortID FROM RESORT WHERE Name = "Berchtesgaden");  END IF;
    IF inResortName LIKE "%oberhof%"            THEN SET outResortID = (SELECT ResortID FROM RESORT WHERE Name = "Oberhof");        END IF;

    
	return outResortID;   
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetSeasonIDFromPeriod` (`inStartDateRent` DATE) RETURNS INT(11)  BEGIN
	
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
	
	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetSurchargePercentFromSeasonAndAreaID` (`inAreaID` INT, `inSeasonID` INT) RETURNS DECIMAL(5,2)  BEGIN
        
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
		
	END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_IsExistingAddress` (`inStreet` VARCHAR(50), `inHnumber` INTEGER, `inZipCode` CHAR(5), `inCity` VARCHAR(50), `inState` VARCHAR(20)) RETURNS INT(11)  begin
	declare outE integer;

    SET outE = 0;
    
        

        IF              (SELECT AddrID FROM ADDR WHERE Street = inStreet AND Hnumber = inHnumber AND ZipCode = inZipCode AND City = inCity AND State = inState) IS NOT NULL
        THEN SET outE = (SELECT AddrID FROM ADDR WHERE Street = inStreet AND Hnumber = inHnumber AND ZipCode = inZipCode AND City = inCity AND State = inState);
        END IF;

    
	return outE;   
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_IsExistingRental` (`inRentalID` INT) RETURNS INT(11)  begin
        return (select rentalID from RENTAL where RentalID = inRentalID) is not null;
    end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ADDR`
--

CREATE TABLE `ADDR` (
  `AddrID` int(11) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `HNumber` int(11) NOT NULL,
  `ZipCode` char(5) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `ADDR`
--

INSERT INTO `ADDR` (`AddrID`, `Street`, `HNumber`, `ZipCode`, `City`, `State`) VALUES
(1, 'Dünenstraße', 11, '17419', 'Aalbeck', 'MVP'),
(2, 'Krummer Weg', 100, '99094', 'Erfurt', 'TH'),
(3, 'Zellaer Straße', 50, '98559', 'Oberhof', 'TH'),
(4, 'Watzmannstraße', 1, '83473', 'Berchtesgaden', 'BY'),
(5, 'Dünenstraße', 12, '17419', 'Aalbeck', 'MVP'),
(6, 'Dünenstraße', 13, '17419', 'Aalbeck', 'MVP'),
(7, 'Dünenstraße', 14, '17419', 'Aalbeck', 'MVP'),
(8, 'Krummer Weg', 101, '99094', 'Erfurt', 'TH'),
(9, 'Krummer Weg', 102, '99094', 'Erfurt', 'TH'),
(10, 'Krummer Weg', 103, '99094', 'Erfurt', 'TH'),
(11, 'Zellaer Straße', 51, '98559', 'Oberhof', 'TH'),
(12, 'Zellaer Straße', 52, '98559', 'Oberhof', 'TH'),
(13, 'Zellaer Straße', 53, '98559', 'Oberhof', 'TH'),
(14, 'Watzmannstraße', 2, '83473', 'Berchtesgaden', 'BY'),
(15, 'Watzmannstraße', 3, '83473', 'Berchtesgaden', 'BY'),
(16, 'Watzmannstraße', 4, '83473', 'Berchtesgaden', 'BY'),
(17, 'Sonnenstraße', 56, '99086', 'Erfurt', 'TH'),
(18, 'Bergstraße', 79, '99084', 'Erfurt', 'TH'),
(19, 'Steigergasse', 54, '99085', 'Erfurt', 'TH'),
(20, 'Frühlingsmarkt', 45, '99086', 'Erfurt', 'TH'),
(21, 'Amselweg', 48, '99085', 'Erfurt', 'TH'),
(22, 'Feldstraße', 36, '99093', 'Erfurt', 'TH'),
(23, 'Nachtigallenweg', 34, '99086', 'Erfurt', 'TH'),
(24, 'Nelkenstr.', 112, '99084', 'Erfurt', 'TH'),
(25, 'Nerlystr.', 9, '99085', 'Erfurt', 'TH'),
(26, 'Nessegrund', 38, '99086', 'Erfurt', 'TH'),
(27, 'Nettelbeckufer', 167, '99085', 'Erfurt', 'TH'),
(28, 'Neue Alacher Chaussee', 87, '99093', 'Erfurt', 'TH'),
(29, 'Neue Str.', 39, '99086', 'Erfurt', 'TH'),
(30, 'Alfred-Brehm-Str.', 22, '99084', 'Erfurt', 'TH'),
(31, 'Alfred-Delp-Ring', 3, '99085', 'Erfurt', 'TH'),
(32, 'Alfred-Hanf-Str.', 7, '99086', 'Erfurt', 'TH'),
(33, 'Alfred-Hess-Str.', 4, '99085', 'Erfurt', 'TH'),
(34, 'Allee', 34, '99093', 'Erfurt', 'TH'),
(35, 'Allerheiligenstr.', 56, '99086', 'Erfurt', 'TH'),
(36, 'Alperstedter Str.', 2, '99084', 'Erfurt', 'TH'),
(37, 'Alperstedter Weg', 3, '99085', 'Erfurt', 'TH'),
(38, 'Alt-Schmidtstedter Weg', 5, '99086', 'Erfurt', 'TH'),
(39, 'Alte Chaussee', 6, '99085', 'Erfurt', 'TH'),
(40, 'Alte Mittelgasse', 7, '17406', 'Usedom', 'MVP'),
(41, 'Alte Mittelhäuser Str.', 98, '17406', 'Usedom', 'MVP'),
(42, 'Alte Mühlhäuser Str.', 4, '17406', 'Usedom', 'MVP'),
(43, 'Alte Schmiede', 2, '17406', 'Usedom', 'MVP'),
(44, 'Fahnerscher Weg', 45, '17406', 'Usedom', 'MVP'),
(45, 'Falkenberger Str.', 4, '17406', 'Usedom', 'MVP'),
(46, 'Falkehäuser Weg', 3, '17406', 'Usedom', 'MVP'),
(47, 'Falkenried', 2, '83471', 'Berchtesgaden', 'BY'),
(48, 'Falkenweg', 3, '83471', 'Berchtesgaden', 'BY'),
(49, 'Falloch', 65, '83471', 'Berchtesgaden', 'BY'),
(50, 'Farbengasse', 7, '83471', 'Berchtesgaden', 'BY'),
(51, 'Fasanenweg', 2, '83471', 'Berchtesgaden', 'BY'),
(52, 'Alte Schulgasse', 4, '83471', 'Berchtesgaden', 'BY'),
(53, 'Altenburg', 6, '83471', 'Berchtesgaden', 'BY'),
(54, 'Altenburger Str.', 4, '83471', 'Berchtesgaden', 'BY'),
(55, 'Nessegrund', 3, '17406', 'Usedom', 'MVP'),
(56, 'Nettelbeckufer', 8, '17406', 'Usedom', 'MVP'),
(57, 'Neue Alacher Chaussee', 6, '17406', 'Usedom', 'MVP'),
(58, 'Neue Str.', 43, '17406', 'Usedom', 'MVP'),
(59, 'Alfred-Brehm-Str.', 2, '17406', 'Usedom', 'MVP'),
(60, 'Adalberthof', 1, '17406', 'Usedom', 'MVP'),
(61, 'Adalbertstr.', 4, '17406', 'Usedom', 'MVP'),
(62, 'Adam-Gottschalk-Str.', 6, '17406', 'Usedom', 'MVP'),
(63, 'Adam-Ries-Str.', 7, '83471', 'Berchtesgaden', 'BY'),
(64, 'Adelheid-Dietrich-Str.', 43, '83471', 'Berchtesgaden', 'BY'),
(65, 'Adolf-Diesterweg-Str.', 65, '83471', 'Berchtesgaden', 'BY'),
(66, 'Adolf-Herzer-Str.', 3, '99093', 'Erfurt', 'TH'),
(67, 'Ahornweg', 21, '99086', 'Erfurt', 'TH'),
(68, 'Akazienallee', 4, '99084', 'Erfurt', 'TH'),
(69, 'Sonnenstraße', 57, '99086', 'Erfurt', 'TH'),
(70, 'Sonnenstraße', 58, '99086', 'Erfurt', 'TH'),
(71, 'Sonnenstraße', 59, '99086', 'Erfurt', 'TH'),
(72, 'Sonnenstraße', 60, '99086', 'Erfurt', 'TH'),
(73, 'Sonnenstraße', 61, '99086', 'Erfurt', 'TH'),
(74, 'Sonnenstraße', 62, '99086', 'Erfurt', 'TH'),
(75, 'Sonnenstraße', 63, '99086', 'Erfurt', 'TH'),
(76, 'Blumenallee', 1, '98559', 'Oberhof', 'TH'),
(77, 'Blumenallee', 2, '98559', 'Oberhof', 'TH'),
(78, 'Blumenallee', 3, '98559', 'Oberhof', 'TH'),
(79, 'Blumenallee', 4, '98559', 'Oberhof', 'TH'),
(80, 'Blumenallee', 5, '98559', 'Oberhof', 'TH'),
(81, 'Blumenallee', 6, '98559', 'Oberhof', 'TH'),
(82, 'Blumenallee', 7, '98559', 'Oberhof', 'TH'),
(83, 'Blumenallee', 8, '98559', 'Oberhof', 'TH'),
(84, 'Siegerstraße', 1, '17406', 'Usedom', 'MVP'),
(85, 'Siegerstraße', 2, '17407', 'Usedom', 'MVP'),
(86, 'Siegerstraße', 3, '17408', 'Usedom', 'MVP'),
(87, 'Siegerstraße', 4, '17409', 'Usedom', 'MVP'),
(88, 'Siegerstraße', 5, '17410', 'Usedom', 'MVP'),
(89, 'Siegerstraße', 6, '17411', 'Usedom', 'MVP'),
(90, 'Siegerstraße', 7, '17412', 'Usedom', 'MVP'),
(91, 'Siegerstraße', 8, '17413', 'Usedom', 'MVP'),
(92, 'Ferienstraße', 1, '83471', 'Berchtesgaden', 'BY'),
(93, 'Ferienstraße', 2, '83471', 'Berchtesgaden', 'BY'),
(94, 'Ferienstraße', 3, '83471', 'Berchtesgaden', 'BY'),
(95, 'Ferienstraße', 4, '83471', 'Berchtesgaden', 'BY'),
(96, 'Ferienstraße', 5, '83471', 'Berchtesgaden', 'BY'),
(97, 'Ferienstraße', 6, '83471', 'Berchtesgaden', 'BY'),
(98, 'Ferienstraße', 7, '83471', 'Berchtesgaden', 'BY'),
(99, 'Ferienstraße', 8, '83471', 'Berchtesgaden', 'BY'),
(100, 'Siegerstraße', 10, '17413', 'Usedom', 'MVP'),
(101, 'Blumenallee', 9, '98559', 'Oberhof', 'TH'),
(102, 'Am Hilfsgraben', 3, '10115', 'Berlin', 'BE');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `APPARTMENT`
--

CREATE TABLE `APPARTMENT` (
  `AppartmentID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `Balcony` enum('Y','N') NOT NULL,
  `Roomnumber` int(11) NOT NULL,
  `Floor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `APPARTMENT`
--

INSERT INTO `APPARTMENT` (`AppartmentID`, `RentalID`, `Balcony`, `Roomnumber`, `Floor`) VALUES
(1, 1, 'Y', 1, 1),
(2, 2, 'N', 2, 1),
(3, 3, 'Y', 3, 2),
(4, 4, 'N', 4, 3),
(5, 5, 'Y', 5, 3),
(6, 9, 'N', 1, 2),
(7, 10, 'Y', 2, 1),
(8, 11, 'N', 3, 2),
(9, 12, 'Y', 4, 2),
(10, 13, 'N', 5, 3),
(11, 17, 'Y', 1, 1),
(12, 18, 'N', 2, 2),
(13, 19, 'Y', 3, 1),
(14, 20, 'N', 4, 2),
(15, 21, 'Y', 5, 3),
(16, 25, 'N', 1, 2),
(17, 26, 'Y', 2, 1),
(18, 27, 'N', 3, 2),
(19, 28, 'Y', 4, 3),
(20, 29, 'N', 5, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `AREA`
--

CREATE TABLE `AREA` (
  `AreaID` int(11) NOT NULL,
  `Name` enum('M','O','C') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `AREA`
--

INSERT INTO `AREA` (`AreaID`, `Name`) VALUES
(10, 'O'),
(20, 'M'),
(30, 'C');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `BOOKING`
--

CREATE TABLE `BOOKING` (
  `BookingID` int(11) NOT NULL,
  `DateBooking` date NOT NULL,
  `StartDateRent` date NOT NULL,
  `EndDateRent` date NOT NULL,
  `PaymentStatus` enum('O','P','C') NOT NULL,
  `GuestID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `BOOKING`
--

INSERT INTO `BOOKING` (`BookingID`, `DateBooking`, `StartDateRent`, `EndDateRent`, `PaymentStatus`, `GuestID`) VALUES
(1, '2020-02-17', '2020-03-30', '2020-04-14', 'P', 1),
(2, '2020-02-28', '2020-05-04', '2020-06-30', 'P', 2),
(3, '2020-03-03', '2020-08-30', '2020-09-09', 'P', 3),
(4, '2020-03-09', '2020-06-30', '2020-07-21', 'C', 4),
(5, '2020-06-28', '2020-07-02', '2020-07-20', 'P', 5),
(6, '2020-07-05', '2022-08-09', '2023-11-15', 'P', 6),
(7, '2020-09-30', '2021-02-15', '2021-03-01', 'P', 7),
(8, '2020-12-25', '2020-12-31', '2021-01-14', 'C', 8),
(9, '2021-01-02', '2021-08-04', '2021-09-30', 'C', 9),
(10, '2021-04-13', '2021-04-20', '2021-04-23', 'O', 10),
(11, '2022-07-17', '2023-07-30', '2023-09-28', 'O', 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `BOOKINGDETAIL`
--

CREATE TABLE `BOOKINGDETAIL` (
  `BookingDetailID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `SurchargeID` int(11) NOT NULL,
  `EndPrice` decimal(10,2) NOT NULL,
  `Status` enum('R','B','C') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `BOOKINGDETAIL`
--

INSERT INTO `BOOKINGDETAIL` (`BookingDetailID`, `BookingID`, `RentalID`, `SurchargeID`, `EndPrice`, `Status`) VALUES
(1, 1, 12, 1, '1700.00', 'B'),
(2, 2, 19, 2, '3335.00', 'B'),
(3, 3, 1, 3, '545.00', 'B'),
(4, 4, 24, 4, '3300.00', 'C'),
(5, 5, 16, 5, '2950.00', 'B'),
(6, 6, 22, 6, '10816.00', 'B'),
(7, 7, 32, 7, '2156.00', 'B'),
(8, 8, 7, 8, '1650.00', 'C'),
(9, 9, 29, 9, '2175.00', 'C'),
(10, 10, 5, 10, '198.00', 'R');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `CLEANING`
--

CREATE TABLE `CLEANING` (
  `CleaningID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `CleaningDate` date NOT NULL,
  `EmpID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `CLEANING`
--

INSERT INTO `CLEANING` (`CleaningID`, `RentalID`, `StartTime`, `EndTime`, `CleaningDate`, `EmpID`) VALUES
(1, 5, '00:00:10', '00:00:11', '2022-12-12', 25),
(2, 28, '00:00:12', '00:00:13', '2022-12-13', 36),
(3, 18, '00:00:14', '00:00:15', '2022-12-14', 32),
(4, 10, '00:00:11', '00:00:12', '2022-12-15', 26),
(5, 2, '00:00:15', '00:00:16', '2022-12-16', 23);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `CRAFTSERV`
--

CREATE TABLE `CRAFTSERV` (
  `CraftServID` int(11) NOT NULL,
  `CompName` varchar(50) NOT NULL,
  `Category` varchar(200) NOT NULL,
  `AddrID` int(11) NOT NULL,
  `Tel` varchar(50) NOT NULL,
  `Mail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `CRAFTSERV`
--

INSERT INTO `CRAFTSERV` (`CraftServID`, `CompName`, `Category`, `AddrID`, `Tel`, `Mail`) VALUES
(1, 'Röhrich Sanitär u. Heizungsbau GmbH', 'Sanitär/Heizung', 17, '259235972', 'walter.röhrich@werner.de'),
(2, 'Peter Immelmann Bauservice GmbH', 'Bau', 18, '572634758', 'p.immelmann@immelmannbau.de'),
(3, 'Malermeiser Mannfred Mümmel GbR', 'Maler', 19, '385736248', 'mannfred.mümmel@maler-mümmel.de'),
(4, 'Fußböden Schwab GmbH', 'Bodenleger', 20, '243253253', 'sascha.schwab@schwab-böden.de'),
(5, 'Elektriker Alexander Marcus KG', 'Elektrik', 21, '327582359', 'alexander.marcus@elektro.de'),
(6, 'Hausmeisterservice Krause', 'Hausmeisterdienst', 22, '925274884', 'dieter.krause@gmail.de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `EMP`
--

CREATE TABLE `EMP` (
  `EmpID` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Job` varchar(50) NOT NULL,
  `ResortID` int(11) NOT NULL,
  `Tel` varchar(50) NOT NULL,
  `Mail` varchar(200) NOT NULL,
  `Manager` int(11) DEFAULT NULL,
  `AddrID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `EMP`
--

INSERT INTO `EMP` (`EmpID`, `FirstName`, `LastName`, `DateOfBirth`, `Job`, `ResortID`, `Tel`, `Mail`, `Manager`, `AddrID`) VALUES
(1, 'Birgitt ', 'Schmidt', '1969-04-20', 'CEO', 10, '6217780989', 'Birgitt.Schmidt@sunshineparks.de', NULL, 23),
(2, 'Rainer ', 'Zufall', '1988-08-15', 'Resort-Manager ', 40, '9769814023', 'Rainer.Zufall@sunshineparks.de', 1, 47),
(3, 'Heinz', 'Aal', '1973-01-05', 'Resort-Manager ', 30, '7386451086', 'Heinz.Aal@sunshineparks.de', 1, 40),
(4, 'Uta', 'Zaun', '1979-09-14', 'Resort-Manager ', 20, '2720655062', 'Uta.Zaun@sunshineparks.de', 1, 24),
(5, 'Sabine', 'Meier', '1993-03-18', 'Resort-Manager ', 10, '8722572513', 'Sabine.Meier@sunshineparks.de', 1, 25),
(6, 'Phillip', 'Franke', '1994-06-10', 'Instandhaltungsverwalter', 10, '8920989094', 'Phillip.Franke@sunshineparks.de', 2, 26),
(7, 'Lukas', 'Lang', '1998-11-27', 'Instandhaltungsverwalter', 20, '7422988599', 'Lukas.Lang@sunshineparks.de', 5, 27),
(8, 'Anna', 'Antoni', '2002-02-22', 'Instandhaltungsverwalter', 30, '7533356159', 'Anna.Antoni@sunshineparks.de', 4, 41),
(9, 'Julia', 'Junker', '1997-07-09', 'Instandhaltungsverwalter', 40, '3981770570', 'Julia.Junker@sunshineparks.de', 3, 48),
(10, 'Maria', 'Marktgraf', '1997-12-24', 'Instandhaltungskraft', 10, '5274706867', 'Maria.Marktgraf@sunshineparks.de', 6, 28),
(11, 'Heinz', 'Halslos', '1966-12-12', 'Instandhaltungskraft', 10, '4556560045', 'Heinz.Halslos@sunshineparks.de', 6, 29),
(12, 'Ernst', 'Haft', '1970-03-17', 'Instandhaltungskraft', 20, '9506513565', 'Ernst.Haft@sunshineparks.de', 7, 30),
(13, 'Elfriede', 'Ebbe', '1959-09-26', 'Instandhaltungskraft', 20, '8853172578', 'Elfriede.Ebbe@sunshineparks.de', 7, 31),
(14, 'Olaf', 'Olafson', '1981-07-06', 'Instandhaltungskraft', 30, '2044104112', 'Olaf.Olafson@sunshineparks.de', 8, 42),
(15, 'Oliver', 'Obermayer', '1978-10-08', 'Instandhaltungskraft', 30, '4201993332', 'Oliver.Obermayer@sunshineparks.de', 8, 43),
(16, 'Ulrich', 'Untermayer', '1973-02-04', 'Instandhaltungskraft', 40, '4323050032', 'Ulrich.Untermayer@sunshineparks.de', 9, 49),
(17, 'Nils', 'Nase', '1981-03-09', 'Instandhaltungskraft', 40, '8928720248', 'Nils.Nase@sunshineparks.de', 9, 50),
(18, 'Zoe', 'Zahn', '1990-10-10', 'Reinigungsverwalter', 10, '9014536497', 'Zoe.Zahn@sunshineparks.de', 5, 32),
(19, 'Ivan', 'Ilcenko', '1978-12-05', 'Reinigungsverwalter', 20, '5886757856', 'Ivan.Ilcenko@sunshineparks.de', 4, 33),
(20, 'Walter', 'Wacker', '1974-11-06', 'Reinigungsverwalter', 30, '7577797599', 'Walter.Wacker@sunshineparks.de', 3, 44),
(21, 'Yvonne', 'Ilmenau', '1989-08-09', 'Reinigungsverwalter', 40, '6851225656', 'Yvonne.Ilmenau@sunshineparks.de', 2, 51),
(22, 'Aaron', 'Aal', '1988-07-16', 'Reinigungskraft', 10, '6052582879', 'Aaron.Aal@sunshineparks.de', 18, 34),
(23, 'Jacob', 'Krönung', '1979-03-14', 'Reinigungskraft', 10, '8692744915', 'Jacob.Krönung@sunshineparks.de', 18, 35),
(24, 'Dieter', 'Däuble', '1958-08-04', 'Reinigungskraft', 10, '5219640683', 'Dieter.Däuble@sunshineparks.de', 18, 36),
(25, 'Dario', 'Dössler', '2002-03-03', 'Reinigungskraft', 10, '6952578235', 'Dario.Dössler@sunshineparks.de', 18, 37),
(26, 'Robin', 'Horris', '1997-01-24', 'Reinigungskraft', 20, '9456278823', 'Robin.Horris@sunshineparks.de', 19, 38),
(27, 'Hendrik', 'Londeckel', '1996-05-10', 'Reinigungskraft', 20, '4148768545', 'Hendrik.Londeckel@sunshineparks.de', 19, 39),
(28, 'Max', 'Scholenz', '2001-09-28', 'Reinigungskraft', 20, '8232772295', 'Max.Scholenz@sunshineparks.de', 19, 21),
(29, 'Yannick', 'Soltrecht', '2001-08-30', 'Reinigungskraft', 20, '3659051759', 'Yannick.Soltrecht@sunshineparks.de', 19, 22),
(30, 'Florenz', 'Runz', '1997-12-06', 'Reinigungskraft', 30, '9038676318', 'Florenz.Runz@sunshineparks.de', 20, 55),
(31, 'Hardy', 'Part', '1955-01-01', 'Reinigungskraft', 30, '6792322685', 'Hardy.Part@sunshineparks.de', 20, 56),
(32, 'Paul', 'Pulmoll', '1977-01-31', 'Reinigungskraft', 30, '7514773459', 'Paul.Pulmoll@sunshineparks.de', 20, 57),
(33, 'Jasper', 'Kasper', '1992-04-15', 'Reinigungskraft', 30, '8586253537', 'Jasper.Kasper@sunshineparks.de', 20, 58),
(34, 'Günther', 'Gübelmann', '1973-03-06', 'Reinigungskraft', 40, '7069540479', 'Günther.Gübelmann@sunshineparks.de', 21, 4),
(35, 'Reiner', 'Richter', '1982-11-29', 'Reinigungskraft', 40, '7545761322', 'Reiner.Richter@sunshineparks.de', 21, 52),
(36, 'Till', 'Tilsiter', '1968-06-08', 'Reinigungskraft', 40, '7765232629', 'Till.Tilsiter@sunshineparks.de', 21, 53),
(37, 'Günther', 'Gümpel', '1959-09-12', 'Reinigungskraft', 40, '2799245426', 'Günther.Gümpel@sunshineparks.de', 21, 54);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `GUEST`
--

CREATE TABLE `GUEST` (
  `GuestID` int(11) NOT NULL,
  `AddrID` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Mail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `GUEST`
--

INSERT INTO `GUEST` (`GuestID`, `AddrID`, `FirstName`, `LastName`, `DateOfBirth`, `Mail`) VALUES
(1, 59, 'Bernd', 'Hahn', '2000-02-01', 'Bernd.Hahn@guest.de'),
(2, 60, 'Thomas', 'Müller', '1994-07-27', 'Thomas.Müller@guest.de'),
(3, 61, 'Philipp', 'Schweinsteiger', '1990-10-04', 'Philipp.Schweinsteiger@guest.de'),
(4, 62, 'Svenja', 'Lahm', '1990-10-03', 'Svenja.Lahm@guest.de'),
(5, 63, 'Bastian', 'Kruse', '1989-11-09', 'Bastian.Kruse@guest.de'),
(6, 64, 'Friedrich', 'Meier', '1953-06-17', 'Friedrich.Meier@guest.de'),
(7, 65, 'Robert', 'Ulrich', '2001-04-15', 'Robert.Ulrich@guest.de'),
(8, 66, 'David ', 'Heinke', '1975-06-19', 'David.Heinke@guest.de'),
(9, 67, 'Dorotheen', 'Schmidt', '1983-09-17', 'Dorotheen.Schmidt@guest.de'),
(10, 68, 'Sylvia', 'Heinrich', '1961-06-29', 'Sylvia.Heinrich@guest.de'),
(11, 102, 'Sippi', 'Klappstuhl', '1993-08-25', 'sippi.klappstuhl93@guest.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `HOUSE`
--

CREATE TABLE `HOUSE` (
  `HouseID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `Terrace` enum('Y','N') NOT NULL,
  `Kitchen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `HOUSE`
--

INSERT INTO `HOUSE` (`HouseID`, `RentalID`, `Terrace`, `Kitchen`) VALUES
(1, 6, 'N', 1),
(2, 7, 'Y', 2),
(3, 8, 'N', 2),
(4, 14, 'N', 1),
(5, 15, 'Y', 2),
(6, 16, 'N', 2),
(7, 22, 'N', 1),
(8, 23, 'Y', 2),
(9, 24, 'N', 2),
(10, 30, 'N', 1),
(11, 31, 'Y', 2),
(12, 32, 'N', 2),
(13, 33, 'Y', 3),
(14, 34, 'Y', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MAINTENANCE`
--

CREATE TABLE `MAINTENANCE` (
  `MaintenanceID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `MaintenanceDate` date NOT NULL,
  `RepairProtocol` varchar(200) DEFAULT NULL,
  `EmpID` int(11) NOT NULL,
  `Active` enum('F','O') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `MAINTENANCE`
--

INSERT INTO `MAINTENANCE` (`MaintenanceID`, `RentalID`, `Description`, `MaintenanceDate`, `RepairProtocol`, `EmpID`, `Active`) VALUES
(1, 12, 'Stuhl kaputt', '2022-04-12', 'Stuhlbein ausgetauscht', 13, 'F'),
(2, 24, 'Toilette spült nicht', '2022-06-15', 'Spülung repariert', 15, 'F'),
(3, 8, 'TV geht nicht mehr an', '2022-06-15', 'Neuen TV installiert', 10, 'F'),
(4, 2, 'Fenster lässt sich nicht mehr kippen', '2020-05-25', 'Fenstergriff ausgetauscht', 11, 'F'),
(5, 18, 'Rechte Bettlampe ghet nicht an', '2021-02-03', 'Glühbirne gewechselt', 14, 'F'),
(6, 8, 'Klima Defekt', '2022-07-17', 'Kühlwasser gewechselt', 10, 'F');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `RENTAL`
--

CREATE TABLE `RENTAL` (
  `RentalID` int(11) NOT NULL,
  `MaxVisitor` int(11) NOT NULL,
  `Bedroom` int(11) NOT NULL,
  `Bathroom` int(11) NOT NULL,
  `SqrMeter` int(11) NOT NULL,
  `BasicPrice` decimal(7,2) NOT NULL,
  `Status` enum('R','N','C','D','M','B') NOT NULL,
  `AreaID` int(11) NOT NULL,
  `ResortID` int(11) NOT NULL,
  `AddrID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `RENTAL`
--

INSERT INTO `RENTAL` (`RentalID`, `MaxVisitor`, `Bedroom`, `Bathroom`, `SqrMeter`, `BasicPrice`, `Status`, `AreaID`, `ResortID`, `AddrID`) VALUES
(1, 4, 2, 2, 60, '30.00', 'C', 30, 10, 17),
(2, 2, 1, 1, 35, '30.00', 'C', 30, 10, 69),
(3, 6, 3, 2, 85, '30.00', 'C', 30, 10, 70),
(4, 6, 3, 3, 100, '30.00', 'C', 30, 10, 71),
(5, 4, 2, 1, 55, '30.00', 'C', 30, 10, 72),
(6, 8, 4, 3, 180, '60.00', 'C', 30, 10, 73),
(7, 12, 6, 4, 225, '60.00', 'C', 30, 10, 74),
(8, 16, 8, 8, 265, '60.00', 'C', 30, 10, 75),
(9, 4, 2, 2, 62, '30.00', 'C', 20, 20, 76),
(10, 2, 1, 1, 35, '30.00', 'M', 20, 20, 77),
(11, 6, 3, 2, 85, '30.00', 'C', 20, 20, 78),
(12, 6, 3, 3, 112, '30.00', 'C', 20, 20, 79),
(13, 4, 2, 1, 55, '30.00', 'C', 20, 20, 80),
(14, 8, 4, 3, 192, '60.00', 'C', 20, 20, 81),
(15, 12, 6, 4, 225, '60.00', 'C', 20, 20, 82),
(16, 16, 8, 3, 265, '60.00', 'C', 20, 20, 83),
(17, 4, 2, 2, 55, '30.00', 'C', 10, 30, 84),
(18, 2, 1, 1, 35, '30.00', 'C', 10, 30, 85),
(19, 6, 3, 2, 85, '30.00', 'C', 10, 30, 86),
(20, 6, 3, 3, 98, '30.00', 'C', 10, 30, 87),
(21, 4, 2, 1, 55, '30.00', 'C', 10, 30, 88),
(22, 8, 4, 3, 178, '60.00', 'C', 10, 30, 89),
(23, 12, 6, 4, 225, '60.00', 'C', 10, 30, 90),
(24, 16, 8, 8, 265, '60.00', 'C', 10, 30, 91),
(25, 4, 2, 2, 61, '30.00', 'C', 20, 40, 92),
(26, 2, 1, 1, 35, '30.00', 'C', 20, 40, 93),
(27, 6, 3, 2, 85, '30.00', 'C', 20, 40, 94),
(28, 6, 3, 3, 105, '30.00', 'C', 20, 40, 95),
(29, 4, 2, 1, 55, '30.00', 'C', 20, 40, 96),
(30, 8, 4, 3, 182, '60.00', 'C', 20, 40, 97),
(31, 12, 6, 4, 225, '60.00', 'C', 20, 40, 98),
(32, 16, 8, 8, 265, '60.00', 'C', 20, 40, 99),
(33, 12, 6, 3, 260, '60.00', 'C', 10, 30, 100),
(34, 12, 8, 4, 330, '60.00', 'C', 20, 20, 101);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `RESORT`
--

CREATE TABLE `RESORT` (
  `ResortID` int(11) NOT NULL,
  `AddrID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `RESORT`
--

INSERT INTO `RESORT` (`ResortID`, `AddrID`, `Name`) VALUES
(10, 17, 'Erfurt'),
(20, 76, 'Oberhof'),
(30, 84, 'Usedom'),
(40, 92, 'Berchtesgaden');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `SEASON`
--

CREATE TABLE `SEASON` (
  `SeasonID` int(11) NOT NULL,
  `Name` enum('O','S','W') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `SEASON`
--

INSERT INTO `SEASON` (`SeasonID`, `Name`) VALUES
(10, 'O'),
(20, 'S'),
(30, 'W');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `STRUCCHANGE`
--

CREATE TABLE `STRUCCHANGE` (
  `ChangeID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `PlannedEndDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `Description` varchar(200) NOT NULL,
  `PlannedCosts` decimal(10,2) NOT NULL,
  `EndCosts` decimal(10,2) DEFAULT NULL,
  `CraftServID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `STRUCCHANGE`
--

INSERT INTO `STRUCCHANGE` (`ChangeID`, `RentalID`, `StartDate`, `PlannedEndDate`, `EndDate`, `Description`, `PlannedCosts`, `EndCosts`, `CraftServID`) VALUES
(1, 6, '2020-01-01', '2020-07-01', '2020-08-22', 'Neubau Ferienwohnung', '180000.00', '190000.00', NULL),
(2, 2, '2020-03-01', '2020-04-01', '2020-04-10', 'Renovierung Fußboden', '20000.00', '22000.00', 4),
(3, 16, '2020-03-15', '2020-04-15', '2020-02-12', 'Renovierung Bad 1 und 2', '30000.00', '32000.00', 1),
(4, 17, '2020-08-01', '2020-08-12', '2020-08-15', 'Renovierung beide Schlafzimmer ', '9000.00', '11500.00', 2),
(5, 31, '2020-09-01', '2020-09-30', '2020-09-24', 'Fußboden Terasse', '6000.00', '5800.00', 4),
(6, 34, '2022-09-01', '2023-06-01', '2022-07-12', 'Neubau Prestige Objekt Oberhof', '500000.00', '456789.99', NULL),
(7, 17, '2020-08-01', '2020-08-12', NULL, 'Test', '9000.00', NULL, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `SURCHARGE`
--

CREATE TABLE `SURCHARGE` (
  `SurchargeID` int(11) NOT NULL,
  `Percent` decimal(5,2) NOT NULL,
  `SeasonID` int(11) NOT NULL,
  `AreaID` int(11) NOT NULL,
  `NumberOfVisitors` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `SURCHARGE`
--

INSERT INTO `SURCHARGE` (`SurchargeID`, `Percent`, `SeasonID`, `AreaID`, `NumberOfVisitors`) VALUES
(1, '25.00', 30, 20, 12),
(2, '15.00', 10, 10, 5),
(3, '10.00', 20, 30, 4),
(4, '20.00', 20, 10, 14),
(5, '15.00', 20, 20, 16),
(6, '15.00', 10, 10, 8),
(7, '25.00', 30, 20, 12),
(8, '10.00', 30, 30, 9),
(9, '25.00', 20, 20, 1),
(10, '10.00', 10, 30, 4),
(11, '10.00', 20, 20, 8);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `s_ShowRenovation`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `s_ShowRenovation` (
`ChangeID` int(11)
,`RentalID` int(11)
,`StartDate` date
,`PlannedEndDate` date
,`EndDate` date
,`Description` varchar(200)
,`PlannedCosts` decimal(10,2)
,`EndCosts` decimal(10,2)
,`CraftServID` int(11)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_getActualMaintenanceAuftrag`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `v_getActualMaintenanceAuftrag` (
`MaintenanceID` int(11)
,`RentalID` int(11)
,`Description` varchar(200)
,`MaintenanceDate` date
,`RepairProtocol` varchar(200)
,`EmpID` int(11)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_getAllMaintenanceRentals`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `v_getAllMaintenanceRentals` (
`RentalID` int(11)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_getAllOpenMaintenanceAuftrag`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `v_getAllOpenMaintenanceAuftrag` (
`MaintenanceID` int(11)
,`RentalID` int(11)
,`Description` varchar(200)
,`MaintenanceDate` date
,`RepairProtocol` varchar(200)
,`EmpID` int(11)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_getReinigungsplan`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `v_getReinigungsplan` (
`FirstName` varchar(30)
,`LastName` varchar(50)
,`StartTime` time
,`CleaningDate` date
,`Street` varchar(50)
,`Hnumber` int(11)
,`ZipCode` char(5)
,`City` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur des Views `s_ShowRenovation`
--
DROP TABLE IF EXISTS `s_ShowRenovation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `s_ShowRenovation`  AS SELECT `STRUCCHANGE`.`ChangeID` AS `ChangeID`, `STRUCCHANGE`.`RentalID` AS `RentalID`, `STRUCCHANGE`.`StartDate` AS `StartDate`, `STRUCCHANGE`.`PlannedEndDate` AS `PlannedEndDate`, `STRUCCHANGE`.`EndDate` AS `EndDate`, `STRUCCHANGE`.`Description` AS `Description`, `STRUCCHANGE`.`PlannedCosts` AS `PlannedCosts`, `STRUCCHANGE`.`EndCosts` AS `EndCosts`, `STRUCCHANGE`.`CraftServID` AS `CraftServID` FROM `STRUCCHANGE` WHERE `STRUCCHANGE`.`EndDate` is null  ;

-- --------------------------------------------------------

--
-- Struktur des Views `v_getActualMaintenanceAuftrag`
--
DROP TABLE IF EXISTS `v_getActualMaintenanceAuftrag`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_getActualMaintenanceAuftrag`  AS SELECT `MAINTENANCE`.`MaintenanceID` AS `MaintenanceID`, `MAINTENANCE`.`RentalID` AS `RentalID`, `MAINTENANCE`.`Description` AS `Description`, `MAINTENANCE`.`MaintenanceDate` AS `MaintenanceDate`, `MAINTENANCE`.`RepairProtocol` AS `RepairProtocol`, `MAINTENANCE`.`EmpID` AS `EmpID` FROM `MAINTENANCE` WHERE `MAINTENANCE`.`Active` = 'O' AND curdate() = `MAINTENANCE`.`MaintenanceDate``MaintenanceDate`  ;

-- --------------------------------------------------------

--
-- Struktur des Views `v_getAllMaintenanceRentals`
--
DROP TABLE IF EXISTS `v_getAllMaintenanceRentals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_getAllMaintenanceRentals`  AS SELECT `RENTAL`.`RentalID` AS `RentalID` FROM `RENTAL` WHERE `RENTAL`.`Status` = 'M''M'  ;

-- --------------------------------------------------------

--
-- Struktur des Views `v_getAllOpenMaintenanceAuftrag`
--
DROP TABLE IF EXISTS `v_getAllOpenMaintenanceAuftrag`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_getAllOpenMaintenanceAuftrag`  AS SELECT `MAINTENANCE`.`MaintenanceID` AS `MaintenanceID`, `MAINTENANCE`.`RentalID` AS `RentalID`, `MAINTENANCE`.`Description` AS `Description`, `MAINTENANCE`.`MaintenanceDate` AS `MaintenanceDate`, `MAINTENANCE`.`RepairProtocol` AS `RepairProtocol`, `MAINTENANCE`.`EmpID` AS `EmpID` FROM `MAINTENANCE` WHERE `MAINTENANCE`.`Active` = 'O''O'  ;

-- --------------------------------------------------------

--
-- Struktur des Views `v_getReinigungsplan`
--
DROP TABLE IF EXISTS `v_getReinigungsplan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_getReinigungsplan`  AS SELECT `EMP`.`FirstName` AS `FirstName`, `EMP`.`LastName` AS `LastName`, `CLEANING`.`StartTime` AS `StartTime`, `CLEANING`.`CleaningDate` AS `CleaningDate`, `ADDR`.`Street` AS `Street`, `ADDR`.`HNumber` AS `Hnumber`, `ADDR`.`ZipCode` AS `ZipCode`, `ADDR`.`City` AS `City` FROM (((`ADDR` join `RENTAL` on(`ADDR`.`AddrID` = `RENTAL`.`AddrID`)) join `CLEANING` on(`RENTAL`.`RentalID` = `CLEANING`.`RentalID`)) join `EMP` on(`CLEANING`.`EmpID` = `EMP`.`EmpID`))  ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ADDR`
--
ALTER TABLE `ADDR`
  ADD PRIMARY KEY (`AddrID`);

--
-- Indizes für die Tabelle `APPARTMENT`
--
ALTER TABLE `APPARTMENT`
  ADD PRIMARY KEY (`AppartmentID`),
  ADD KEY `appartment_rentalid_fk` (`RentalID`);

--
-- Indizes für die Tabelle `AREA`
--
ALTER TABLE `AREA`
  ADD PRIMARY KEY (`AreaID`);

--
-- Indizes für die Tabelle `BOOKING`
--
ALTER TABLE `BOOKING`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `booking_guestid_fk` (`GuestID`);

--
-- Indizes für die Tabelle `BOOKINGDETAIL`
--
ALTER TABLE `BOOKINGDETAIL`
  ADD PRIMARY KEY (`BookingDetailID`),
  ADD KEY `bookingdetail_bookingid_fk` (`BookingID`),
  ADD KEY `bookingdetail_rentalid_fk` (`RentalID`),
  ADD KEY `bookingdetail_surchargeid_fk` (`SurchargeID`);

--
-- Indizes für die Tabelle `CLEANING`
--
ALTER TABLE `CLEANING`
  ADD PRIMARY KEY (`CleaningID`),
  ADD KEY `cleaning_rentalid_fk` (`RentalID`),
  ADD KEY `cleaning_empid_fk` (`EmpID`);

--
-- Indizes für die Tabelle `CRAFTSERV`
--
ALTER TABLE `CRAFTSERV`
  ADD PRIMARY KEY (`CraftServID`),
  ADD KEY `craftserv_addrid_fk` (`AddrID`);

--
-- Indizes für die Tabelle `EMP`
--
ALTER TABLE `EMP`
  ADD PRIMARY KEY (`EmpID`),
  ADD KEY `emp_resortid_fk` (`ResortID`),
  ADD KEY `emp_empid_fk` (`Manager`),
  ADD KEY `emp_addrid_fk` (`AddrID`);

--
-- Indizes für die Tabelle `GUEST`
--
ALTER TABLE `GUEST`
  ADD PRIMARY KEY (`GuestID`),
  ADD KEY `guest_addrid_fk` (`AddrID`);

--
-- Indizes für die Tabelle `HOUSE`
--
ALTER TABLE `HOUSE`
  ADD PRIMARY KEY (`HouseID`),
  ADD KEY `house_rentalid_fk` (`RentalID`);

--
-- Indizes für die Tabelle `MAINTENANCE`
--
ALTER TABLE `MAINTENANCE`
  ADD PRIMARY KEY (`MaintenanceID`),
  ADD KEY `maintenance_rentalid_fk` (`RentalID`),
  ADD KEY `maintenance_empid_fk` (`EmpID`);

--
-- Indizes für die Tabelle `RENTAL`
--
ALTER TABLE `RENTAL`
  ADD PRIMARY KEY (`RentalID`),
  ADD KEY `rental_areaid_fk` (`AreaID`),
  ADD KEY `rental_resortid_fk` (`ResortID`),
  ADD KEY `rental_addrid_fk` (`AddrID`);

--
-- Indizes für die Tabelle `RESORT`
--
ALTER TABLE `RESORT`
  ADD PRIMARY KEY (`ResortID`),
  ADD KEY `resort_addrid_fk` (`AddrID`);

--
-- Indizes für die Tabelle `SEASON`
--
ALTER TABLE `SEASON`
  ADD PRIMARY KEY (`SeasonID`);

--
-- Indizes für die Tabelle `STRUCCHANGE`
--
ALTER TABLE `STRUCCHANGE`
  ADD PRIMARY KEY (`ChangeID`),
  ADD KEY `strucchange_rentalid_fk` (`RentalID`),
  ADD KEY `strucchange_craftservid_fk` (`CraftServID`);

--
-- Indizes für die Tabelle `SURCHARGE`
--
ALTER TABLE `SURCHARGE`
  ADD PRIMARY KEY (`SurchargeID`),
  ADD KEY `surcharge_seasonid_fk` (`SeasonID`),
  ADD KEY `surcharge_areaid_fk` (`AreaID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ADDR`
--
ALTER TABLE `ADDR`
  MODIFY `AddrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT für Tabelle `APPARTMENT`
--
ALTER TABLE `APPARTMENT`
  MODIFY `AppartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `AREA`
--
ALTER TABLE `AREA`
  MODIFY `AreaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT für Tabelle `BOOKING`
--
ALTER TABLE `BOOKING`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `BOOKINGDETAIL`
--
ALTER TABLE `BOOKINGDETAIL`
  MODIFY `BookingDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `CLEANING`
--
ALTER TABLE `CLEANING`
  MODIFY `CleaningID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `EMP`
--
ALTER TABLE `EMP`
  MODIFY `EmpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT für Tabelle `GUEST`
--
ALTER TABLE `GUEST`
  MODIFY `GuestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `HOUSE`
--
ALTER TABLE `HOUSE`
  MODIFY `HouseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `MAINTENANCE`
--
ALTER TABLE `MAINTENANCE`
  MODIFY `MaintenanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `RENTAL`
--
ALTER TABLE `RENTAL`
  MODIFY `RentalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT für Tabelle `RESORT`
--
ALTER TABLE `RESORT`
  MODIFY `ResortID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT für Tabelle `STRUCCHANGE`
--
ALTER TABLE `STRUCCHANGE`
  MODIFY `ChangeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `SURCHARGE`
--
ALTER TABLE `SURCHARGE`
  MODIFY `SurchargeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `APPARTMENT`
--
ALTER TABLE `APPARTMENT`
  ADD CONSTRAINT `appartment_rentalid_fk` FOREIGN KEY (`RentalID`) REFERENCES `RENTAL` (`RentalID`);

--
-- Constraints der Tabelle `BOOKING`
--
ALTER TABLE `BOOKING`
  ADD CONSTRAINT `booking_guestid_fk` FOREIGN KEY (`GuestID`) REFERENCES `GUEST` (`GuestID`);

--
-- Constraints der Tabelle `BOOKINGDETAIL`
--
ALTER TABLE `BOOKINGDETAIL`
  ADD CONSTRAINT `bookingdetail_bookingid_fk` FOREIGN KEY (`BookingID`) REFERENCES `BOOKING` (`BookingID`),
  ADD CONSTRAINT `bookingdetail_rentalid_fk` FOREIGN KEY (`RentalID`) REFERENCES `RENTAL` (`RentalID`),
  ADD CONSTRAINT `bookingdetail_surchargeid_fk` FOREIGN KEY (`SurchargeID`) REFERENCES `SURCHARGE` (`SurchargeID`);

--
-- Constraints der Tabelle `CLEANING`
--
ALTER TABLE `CLEANING`
  ADD CONSTRAINT `cleaning_empid_fk` FOREIGN KEY (`EmpID`) REFERENCES `EMP` (`EmpID`),
  ADD CONSTRAINT `cleaning_rentalid_fk` FOREIGN KEY (`RentalID`) REFERENCES `RENTAL` (`RentalID`);

--
-- Constraints der Tabelle `CRAFTSERV`
--
ALTER TABLE `CRAFTSERV`
  ADD CONSTRAINT `craftserv_addrid_fk` FOREIGN KEY (`AddrID`) REFERENCES `ADDR` (`AddrID`);

--
-- Constraints der Tabelle `EMP`
--
ALTER TABLE `EMP`
  ADD CONSTRAINT `emp_addrid_fk` FOREIGN KEY (`AddrID`) REFERENCES `ADDR` (`AddrID`),
  ADD CONSTRAINT `emp_empid_fk` FOREIGN KEY (`Manager`) REFERENCES `EMP` (`EmpID`),
  ADD CONSTRAINT `emp_resortid_fk` FOREIGN KEY (`ResortID`) REFERENCES `RESORT` (`ResortID`);

--
-- Constraints der Tabelle `GUEST`
--
ALTER TABLE `GUEST`
  ADD CONSTRAINT `guest_addrid_fk` FOREIGN KEY (`AddrID`) REFERENCES `ADDR` (`AddrID`);

--
-- Constraints der Tabelle `HOUSE`
--
ALTER TABLE `HOUSE`
  ADD CONSTRAINT `house_rentalid_fk` FOREIGN KEY (`RentalID`) REFERENCES `RENTAL` (`RentalID`);

--
-- Constraints der Tabelle `MAINTENANCE`
--
ALTER TABLE `MAINTENANCE`
  ADD CONSTRAINT `maintenance_empid_fk` FOREIGN KEY (`EmpID`) REFERENCES `EMP` (`EmpID`),
  ADD CONSTRAINT `maintenance_rentalid_fk` FOREIGN KEY (`RentalID`) REFERENCES `RENTAL` (`RentalID`);

--
-- Constraints der Tabelle `RENTAL`
--
ALTER TABLE `RENTAL`
  ADD CONSTRAINT `rental_addrid_fk` FOREIGN KEY (`AddrID`) REFERENCES `ADDR` (`AddrID`),
  ADD CONSTRAINT `rental_areaid_fk` FOREIGN KEY (`AreaID`) REFERENCES `AREA` (`AreaID`),
  ADD CONSTRAINT `rental_resortid_fk` FOREIGN KEY (`ResortID`) REFERENCES `RESORT` (`ResortID`);

--
-- Constraints der Tabelle `RESORT`
--
ALTER TABLE `RESORT`
  ADD CONSTRAINT `resort_addrid_fk` FOREIGN KEY (`AddrID`) REFERENCES `ADDR` (`AddrID`);

--
-- Constraints der Tabelle `STRUCCHANGE`
--
ALTER TABLE `STRUCCHANGE`
  ADD CONSTRAINT `strucchange_craftservid_fk` FOREIGN KEY (`CraftServID`) REFERENCES `CRAFTSERV` (`CraftServID`),
  ADD CONSTRAINT `strucchange_rentalid_fk` FOREIGN KEY (`RentalID`) REFERENCES `RENTAL` (`RentalID`);

--
-- Constraints der Tabelle `SURCHARGE`
--
ALTER TABLE `SURCHARGE`
  ADD CONSTRAINT `surcharge_areaid_fk` FOREIGN KEY (`AreaID`) REFERENCES `AREA` (`AreaID`),
  ADD CONSTRAINT `surcharge_seasonid_fk` FOREIGN KEY (`SeasonID`) REFERENCES `SEASON` (`SeasonID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
