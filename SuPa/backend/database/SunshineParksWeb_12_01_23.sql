-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 12. Jan 2023 um 12:38
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS SunshineParksWeb;
CREATE DATABASE SunshineParksWeb;
USE SunshineParksWeb;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `SunshineParksWeb`
--

DELIMITER $$
--
-- Prozeduren
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_CompleteNewBuilding` (`inRentalID` INT, `inEndDate` DATE, `inEndCosts` DECIMAL(10,2))   begin
        UPDATE STRUCCHANGE 
        SET EndDate = inEndDate, EndCosts = inEndCosts
        WHERE (RentalID = inRentalID);

        UPDATE RENTAL
        SET Status = 'C'
        WHERE (RentalID = inRentalID);


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


		SELECT inRentalID;
	end$$

--
-- Funktionen
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetAreaID` (`inResortName` VARCHAR(20)) RETURNS INT(11)  begin
	declare outAreaID integer;
    
    IF inResortName LIKE "%erfurt%"         THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'C'); END IF;
    IF inResortName LIKE "%oberhof%"        THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'M'); END IF;
    IF inResortName LIKE "%usedom%"         THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'O'); END IF;
    IF inResortName LIKE "%berchtesgaden%"  THEN SET outAreaID = (SELECT AreaID FROM AREA WHERE Name = 'M'); END IF;

    
	return outAreaID;   
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_GetRentalAddrID` (`inValue` INTEGER) RETURNS INT(11)  begin
	declare outAddrID integer;


    
    set outAddrID = (   select ADDR.AddrID 
                        from ADDR 
                        join RENTAL on ADDR.AddrID = RENTAL.AddrID
                        where RENTAL.RentalID = inValue);

    
	return outAddrID;   
END$$

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

CREATE DEFINER=`root`@`localhost` FUNCTION `fn_IsExistingAddress` (`inStreet` VARCHAR(50), `inHnumber` INTEGER, `inZipCode` CHAR(5), `inCity` VARCHAR(50), `inState` VARCHAR(20)) RETURNS INT(11)  begin
	declare outE integer;

    SET outE = 0;
    
        

        IF              (SELECT AddrID FROM ADDR WHERE Street = inStreet AND Hnumber = inHnumber AND ZipCode = inZipCode AND City = inCity AND State = inState) IS NOT NULL
        THEN SET outE = (SELECT AddrID FROM ADDR WHERE Street = inStreet AND Hnumber = inHnumber AND ZipCode = inZipCode AND City = inCity AND State = inState);
        END IF;

    
	return outE;   
END$$

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
(99, 'Ferienstraße', 8, '83471', 'Berchtesgaden', 'BY');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ADMIN`
--

CREATE TABLE `ADMIN` (
  `AdminID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `ADMIN`
--

INSERT INTO `ADMIN` (`AdminID`, `PersonID`) VALUES
(2, 25),
(1, 48);

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
(10, '2021-04-13', '2021-04-20', '2021-04-23', 'O', 10);

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
  `PersonID` int(11) NOT NULL,
  `Job` varchar(50) NOT NULL,
  `ResortID` int(11) NOT NULL,
  `Manager` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `EMP`
--

INSERT INTO `EMP` (`EmpID`, `PersonID`, `Job`, `ResortID`, `Manager`) VALUES
(1, 1, 'CEO', 10, 1),
(2, 2, 'Resort-Manager ', 40, 1),
(3, 3, 'Resort-Manager ', 30, 1),
(4, 4, 'Resort-Manager ', 30, 1),
(5, 5, 'Resort-Manager ', 10, 1),
(6, 6, 'Instandhaltungsverwalter', 10, 2),
(7, 7, 'Instandhaltungsverwalter', 20, 5),
(8, 8, 'Instandhaltungsverwalter', 30, 4),
(9, 9, 'Instandhaltungsverwalter', 40, 3),
(10, 10, 'Instandhaltungskraft', 10, 6),
(11, 11, 'Instandhaltungskraft', 10, 6),
(12, 12, 'Instandhaltungskraft', 20, 7),
(13, 13, 'Instandhaltungskraft', 20, 7),
(14, 14, 'Instandhaltungskraft', 30, 8),
(15, 15, 'Instandhaltungskraft', 30, 8),
(16, 16, 'Instandhaltungskraft', 40, 9),
(17, 17, 'Instandhaltungskraft', 40, 9),
(18, 18, 'Reinigungsverwalter', 10, 5),
(19, 19, 'Reinigungsverwalter', 20, 4),
(20, 20, 'Reinigungsverwalter', 30, 3),
(21, 21, 'Reinigungsverwalter', 40, 2),
(22, 22, 'Reinigungskraft', 10, 18),
(23, 23, 'Reinigungskraft', 10, 18),
(24, 24, 'Reinigungskraft', 10, 18),
(25, 25, 'Reinigungskraft', 10, 18),
(26, 26, 'Reinigungskraft', 20, 19),
(27, 27, 'Reinigungskraft', 20, 19),
(28, 28, 'Reinigungskraft', 20, 19),
(29, 29, 'Reinigungskraft', 20, 19),
(30, 30, 'Reinigungskraft', 30, 20),
(31, 31, 'Reinigungskraft', 30, 20),
(32, 32, 'Reinigungskraft', 30, 20),
(33, 33, 'Reinigungskraft', 30, 20),
(34, 34, 'Reinigungskraft', 40, 21),
(35, 35, 'Reinigungskraft', 40, 21),
(36, 36, 'Reinigungskraft', 40, 21),
(37, 37, 'Reinigungskraft', 40, 21);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `GUEST`
--

CREATE TABLE `GUEST` (
  `GuestID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `GUEST`
--

INSERT INTO `GUEST` (`GuestID`, `PersonID`) VALUES
(1, 38),
(2, 39),
(3, 40),
(4, 41),
(5, 42),
(6, 43),
(7, 44),
(8, 45),
(9, 46),
(10, 47);

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
(12, 32, 'N', 2);

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
(5, 18, 'Rechte Bettlampe ghet nicht an', '2021-02-03', 'Glühbirne gewechselt', 14, 'F');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MODE`
--

CREATE TABLE `MODE` (
  `ModeID` int(11) NOT NULL,
  `Role` enum('A','C','M','Mgr','R','B','G') NOT NULL,
  `AddNewEmp` enum('Y','N') NOT NULL,
  `AddNewGuest` enum('Y','N') NOT NULL,
  `CreateCleaningPlan` enum('Y','N') NOT NULL,
  `ReportDamageRepair` enum('Y','N') NOT NULL,
  `ShowRepair` enum('Y','N') NOT NULL,
  `EditRepair` enum('Y','N') NOT NULL,
  `AddRental` enum('Y','N') NOT NULL,
  `EditRental` enum('Y','N') NOT NULL,
  `DeactivateRental` enum('Y','N') NOT NULL,
  `ShowRental` enum('Y','N') NOT NULL,
  `AddRenovation` enum('Y','N') NOT NULL,
  `EditRenovation` enum('Y','N') NOT NULL,
  `ShowRenovation` enum('Y','N') NOT NULL,
  `AddNewBuilding` enum('Y','N') NOT NULL,
  `EditNewBuilding` enum('Y','N') NOT NULL,
  `CloseNewBuildingProcess` enum('Y','N') NOT NULL,
  `ShowNewBuildingRental` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `MODE`
--

INSERT INTO `MODE` (`ModeID`, `Role`, `AddNewEmp`, `AddNewGuest`, `CreateCleaningPlan`, `ReportDamageRepair`, `ShowRepair`, `EditRepair`, `AddRental`, `EditRental`, `DeactivateRental`, `ShowRental`, `AddRenovation`, `EditRenovation`, `ShowRenovation`, `AddNewBuilding`, `EditNewBuilding`, `CloseNewBuildingProcess`, `ShowNewBuildingRental`) VALUES
(1, 'A', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(2, 'C', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y'),
(3, 'M', 'N', 'N', 'Y', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y'),
(4, 'Mgr', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'N', 'N', 'Y'),
(5, 'R', 'N', 'N', 'Y', 'N', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(6, 'B', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y'),
(7, 'G', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `PERSON`
--

CREATE TABLE `PERSON` (
  `PersonID` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Tel` varchar(50) NOT NULL,
  `Mail` varchar(200) NOT NULL,
  `AddrID` int(11) NOT NULL,
  `PasswordHash` varchar(200) NOT NULL,
  `AccountType` enum('A','G','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `PERSON`
--

INSERT INTO `PERSON` (`PersonID`, `FirstName`, `LastName`, `DateOfBirth`, `Tel`, `Mail`, `AddrID`, `PasswordHash`, `AccountType`) VALUES
(1, 'Birgitt ', 'Schmidt', '1969-04-20', '6217780989', 'Birgitt.Schmidt@sunshineparks.de', 23, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(2, 'Rainer ', 'Zufall', '1988-08-15', '9769814023', 'Rainer.Zufall@sunshineparks.de', 47, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(3, 'Heinz', 'Aal', '1973-01-05', '7386451086', 'Heinz.Aal@sunshineparks.de', 40, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(4, 'Uta', 'Zaun', '1979-09-14', '2720655062', 'Uta.Zaun@sunshineparks.de', 24, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(5, 'Sabine', 'Meier', '1993-03-18', '8722572513', 'Sabine.Meier@sunshineparks.de', 25, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(6, 'Phillip', 'Franke', '1994-06-10', '8920989094', 'Phillip.Franke@sunshineparks.de', 26, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(7, 'Lukas', 'Lang', '1998-11-27', '7422988599', 'Lukas.Lang@sunshineparks.de', 27, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(8, 'Anna', 'Antoni', '2002-02-22', '7533356159', 'Anna.Antoni@sunshineparks.de', 41, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(9, 'Julia', 'Junker', '1997-07-09', '3981770570', 'Julia.Junker@sunshineparks.de', 48, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(10, 'Maria', 'Marktgraf', '1997-12-24', '5274706867', 'Maria.Marktgraf@sunshineparks.de', 28, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(11, 'Heinz', 'Halslos', '1966-12-12', '4556560045', 'Heinz.Halslos@sunshineparks.de', 29, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(12, 'Ernst', 'Haft', '1970-03-17', '9506513565', 'Ernst.Haft@sunshineparks.de', 30, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(13, 'Elfriede', 'Ebbe', '1959-09-26', '8853172578', 'Elfriede.Ebbe@sunshineparks.de', 31, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(14, 'Olaf', 'Olafson', '1981-07-06', '2044104112', 'Olaf.Olafson@sunshineparks.de', 42, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(15, 'Oliver', 'Obermayer', '1978-10-08', '4201993332', 'Oliver.Obermayer@sunshineparks.de', 43, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(16, 'Ulrich', 'Untermayer', '1973-02-04', '4323050032', 'Ulrich.Untermayer@sunshineparks.de', 49, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(17, 'Nils', 'Nase', '1981-03-09', '8928720248', 'Nils.Nase@sunshineparks.de', 50, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(18, 'Zoe', 'Zahn', '1990-10-10', '9014536497', 'Zoe.Zahn@sunshineparks.de', 32, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(19, 'Ivan', 'Ilcenko', '1978-12-05', '5886757856', 'Ivan.Ilcenko@sunshineparks.de', 33, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(20, 'Walter', 'Wacker', '1974-11-06', '7577797599', 'Walter.Wacker@sunshineparks.de', 44, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(21, 'Yvonne', 'Ilmenau', '1989-08-09', '6851225656', 'Yvonne.Ilmenau@sunshineparks.de', 51, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(22, 'Aaron', 'Aal', '1988-07-16', '6052582879', 'Aaron.Aal@sunshineparks.de', 34, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(23, 'Jacob', 'Krönung', '1979-03-14', '8692744915', 'Jacob.Krönung@sunshineparks.de', 35, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(24, 'Dieter', 'Däuble', '1958-08-04', '5219640683', 'Dieter.Däuble@sunshineparks.de', 36, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(25, 'Dario', 'Dössler', '2002-03-03', '6952578235', 'Dario.Dössler@sunshineparks.de', 37, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'A'),
(26, 'Robin', 'Horris', '1997-01-24', '9456278823', 'Robin.Horris@sunshineparks.de', 38, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(27, 'Hendrik', 'Londeckel', '1996-05-10', '4148768545', 'Hendrik.Londeckel@sunshineparks.de', 39, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(28, 'Max', 'Scholenz', '2001-09-28', '8232772295', 'Max.Scholenz@sunshineparks.de', 21, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(29, 'Yannick', 'Soltrecht', '2001-08-30', '3659051759', 'Yannick.Soltrecht@sunshineparks.de', 22, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(30, 'Florenz', 'Runz', '1997-12-06', '9038676318', 'Florenz.Runz@sunshineparks.de', 55, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(31, 'Hardy', 'Part', '1955-01-01', '6792322685', 'Hardy.Part@sunshineparks.de', 56, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(32, 'Paul', 'Pulmoll', '1977-01-31', '7514773459', 'Paul.Pulmoll@sunshineparks.de', 57, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(33, 'Jasper', 'Kasper', '1992-04-15', '8586253537', 'Jasper.Kasper@sunshineparks.de', 58, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(34, 'Günther', 'Gübelmann', '1973-03-06', '7069540479', 'Günther.Gübelmann@sunshineparks.de', 4, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(35, 'Reiner', 'Richter', '1982-11-29', '7545761322', 'Reiner.Richter@sunshineparks.de', 52, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(36, 'Till', 'Tilsiter', '1968-06-08', '7765232629', 'Till.Tilsiter@sunshineparks.de', 53, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(37, 'Günther', 'Gümpel', '1959-09-12', '2799245426', 'Günther.Gümpel@sunshineparks.de', 54, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'E'),
(38, 'Bernd', 'Hahn', '2000-02-01', '5219640683', 'Bernd.Hahn@guest.de', 59, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(39, 'Thomas', 'Müller', '1994-07-27', '6952578235', 'Thomas.Müller@guest.de', 60, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(40, 'Philipp', 'Schweinsteiger', '1990-10-04', '9456278823', 'Philipp.Schweinsteiger@guest.de', 61, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(41, 'Svenja', 'Lahm', '1990-10-03', '4148768545', 'Svenja.Lahm@guest.de', 62, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(42, 'Bastian', 'Kruse', '1989-11-09', '8232772295', 'Bastian.Kruse@guest.de', 63, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(43, 'Friedrich', 'Meier', '1953-06-17', '3659051759', 'Friedrich.Meier@guest.de', 64, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(44, 'Robert', 'Ulrich', '2001-04-15', '9038676318', 'Robert.Ulrich@guest.de', 65, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(45, 'David ', 'Heinke', '1975-06-19', '6792322685', 'David.Heinke@guest.de', 66, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(46, 'Dorotheen', 'Schmidt', '1983-09-17', '7514773459', 'Dorotheen.Schmidt@guest.de', 67, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(47, 'Sylvia', 'Heinrich', '1961-06-29', '8586253537', 'Sylvia.Heinrich@guest.de', 68, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'G'),
(48, 'Hendrik', 'Lendeckel', '1996-10-22', '15140244595', 'hendrik.lendeckel@fh-erfurt.de', 62, '$2y$10$dsZfBjVdpw.6X5oQGALNIewFRy6/Mi9OHBCa0PvjcfnVQ6R0KnaGi', 'A');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `PERSONMODE`
--

CREATE TABLE `PERSONMODE` (
  `PersonModeID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL,
  `ModeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `PERSONMODE`
--

INSERT INTO `PERSONMODE` (`PersonModeID`, `PersonID`, `ModeID`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 3, 4),
(4, 4, 4),
(5, 5, 4),
(6, 6, 4),
(7, 7, 4),
(8, 8, 4),
(9, 9, 4),
(10, 10, 3),
(11, 11, 3),
(12, 12, 3),
(13, 13, 3),
(14, 14, 3),
(15, 15, 3),
(16, 16, 3),
(17, 17, 3),
(18, 18, 4),
(19, 19, 4),
(20, 20, 4),
(21, 21, 4),
(22, 22, 2),
(23, 23, 2),
(24, 24, 2),
(25, 25, 1),
(26, 26, 2),
(27, 27, 2),
(28, 28, 2),
(29, 29, 2),
(30, 30, 2),
(31, 31, 2),
(32, 32, 2),
(33, 33, 2),
(34, 34, 2),
(35, 35, 2),
(36, 36, 2),
(37, 37, 2),
(38, 38, 7),
(39, 39, 7),
(40, 40, 7),
(41, 41, 7),
(42, 42, 7),
(43, 43, 7),
(44, 44, 7),
(45, 45, 7),
(46, 46, 7),
(47, 47, 7),
(48, 48, 1);

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
(10, 2, 1, 1, 35, '30.00', 'C', 20, 20, 77),
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
(32, 16, 8, 8, 265, '60.00', 'C', 20, 40, 99);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `RENTALPICTURES`
--

CREATE TABLE `RENTALPICTURES` (
  `RentalPicturesID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `Path` varchar(300) NOT NULL,
  `Description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `RENTALPICTURES`
--

INSERT INTO `RENTALPICTURES` (`RentalPicturesID`, `RentalID`, `Path`, `Description`) VALUES
(1, 1, 'SuPa/assets/graphics/Objekte/Appartment/Erfurt/Erfurt1.jpg', 'Beschreibung'),
(2, 2, 'SuPa/assets/graphics/Objekte/Appartment/Erfurt/Erfurt2.jpg', 'Beschreibung'),
(3, 3, 'SuPa/assets/graphics/Objekte/Appartment/Erfurt/Erfurt3.jpg', 'Beschreibung'),
(4, 4, 'SuPa/assets/graphics/Objekte/Appartment/Erfurt/Erfurt4.jpg', 'Beschreibung'),
(5, 5, 'SuPa/assets/graphics/Objekte/Appartment/Erfurt/Erfurt5.jpg', 'Beschreibung'),
(6, 6, 'SuPa/assets/graphics/Objekte/Haus/Erfurt/Erfurt1.jpg', 'Beschreibung'),
(7, 7, 'SuPa/assets/graphics/Objekte/Haus/Erfurt/Erfurt2.jpg', 'Beschreibung'),
(8, 8, 'SuPa/assets/graphics/Objekte/Haus/Erfurt/Erfurt3.jpg', 'Beschreibung'),
(9, 9, 'SuPa/assets/graphics/Objekte/Appartment/Oberhof/Oberhof1.jpg', 'Beschreibung'),
(10, 10, 'SuPa/assets/graphics/Objekte/Appartment/Oberhof/Oberhof2.jpg', 'Beschreibung'),
(11, 11, 'SuPa/assets/graphics/Objekte/Appartment/Oberhof/Oberhof3.jpg', 'Beschreibung'),
(12, 12, 'SuPa/assets/graphics/Objekte/Appartment/Oberhof/Oberhof4.jpg', 'Beschreibung'),
(13, 13, 'SuPa/assets/graphics/Objekte/Appartment/Oberhof/Oberhof5.jpg', 'Beschreibung'),
(14, 14, 'SuPa/assets/graphics/Objekte/Haus/Oberhof/Oberhof1.jpg', 'Beschreibung'),
(15, 15, 'SuPa/assets/graphics/Objekte/Haus/Oberhof/Oberhof2.jpg', 'Beschreibung'),
(16, 16, 'SuPa/assets/graphics/Objekte/Haus/Oberhof/Oberhof3.jpg', 'Beschreibung'),
(17, 17, 'SuPa/assets/graphics/Objekte/Appartment/Usedom/Usedom1.jpg', 'Beschreibung'),
(18, 18, 'SuPa/assets/graphics/Objekte/Appartment/Usedom/Usedom2.jpg', 'Beschreibung'),
(19, 19, 'SuPa/assets/graphics/Objekte/Appartment/Usedom/Usedom3.jpg', 'Beschreibung'),
(20, 20, 'SuPa/assets/graphics/Objekte/Appartment/Usedom/Usedom4.jpg', 'Beschreibung'),
(21, 21, 'SuPa/assets/graphics/Objekte/Appartment/Usedom/Usedom5.jpg', 'Beschreibung'),
(22, 22, 'SuPa/assets/graphics/Objekte/Haus/Usedom/Usedom1.jpg', 'Beschreibung'),
(23, 23, 'SuPa/assets/graphics/Objekte/Haus/Usedom/Usedom2.jpg', 'Beschreibung'),
(24, 24, 'SuPa/assets/graphics/Objekte/Haus/Usedom/Usedom3.jpg', 'Beschreibung'),
(25, 25, 'SuPa/assets/graphics/Objekte/Appartment/Berchtesgaden/Berchtedgaden1.jpg', 'Beschreibung'),
(26, 26, 'SuPa/assets/graphics/Objekte/Appartment/Berchtesgaden/Berchtedgaden2.jpg', 'Beschreibung'),
(27, 27, 'SuPa/assets/graphics/Objekte/Appartment/Berchtesgaden/Berchtedgaden3.jpg', 'Beschreibung'),
(28, 28, 'SuPa/assets/graphics/Objekte/Appartment/Berchtesgaden/Berchtedgaden4.jpg', 'Beschreibung'),
(29, 29, 'SuPa/assets/graphics/Objekte/Appartment/Berchtesgaden/Berchtedgaden5.jpg', 'Beschreibung'),
(30, 30, 'SuPa/assets/graphics/Objekte/Haus/Berchtesgaden/Berchtedgaden1.jpg', 'Beschreibung'),
(31, 31, 'SuPa/assets/graphics/Objekte/Haus/Berchtesgaden/Berchtedgaden2.jpg', 'Beschreibung'),
(32, 32, 'SuPa/assets/graphics/Objekte/Haus/Berchtesgaden/Berchtedgaden3.jpg', 'Beschreibung');

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
(5, 31, '2020-09-01', '2020-09-30', '2020-09-24', 'Fußboden Terasse', '6000.00', '5800.00', 4);

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
(10, '10.00', 10, 30, 4);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ADDR`
--
ALTER TABLE `ADDR`
  ADD PRIMARY KEY (`AddrID`);

--
-- Indizes für die Tabelle `ADMIN`
--
ALTER TABLE `ADMIN`
  ADD PRIMARY KEY (`AdminID`),
  ADD KEY `admin_personid_fk` (`PersonID`);

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
  ADD KEY `emp_personid_fk` (`PersonID`),
  ADD KEY `emp_resortid_fk` (`ResortID`),
  ADD KEY `emp_empid_fk` (`Manager`);

--
-- Indizes für die Tabelle `GUEST`
--
ALTER TABLE `GUEST`
  ADD PRIMARY KEY (`GuestID`),
  ADD KEY `guest_personid_fk` (`PersonID`);

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
-- Indizes für die Tabelle `MODE`
--
ALTER TABLE `MODE`
  ADD PRIMARY KEY (`ModeID`);

--
-- Indizes für die Tabelle `PERSON`
--
ALTER TABLE `PERSON`
  ADD PRIMARY KEY (`PersonID`),
  ADD KEY `person_addrid_fk` (`AddrID`);

--
-- Indizes für die Tabelle `PERSONMODE`
--
ALTER TABLE `PERSONMODE`
  ADD PRIMARY KEY (`PersonModeID`),
  ADD KEY `personmode_personid_fk` (`PersonID`),
  ADD KEY `personmode_modeid_fk` (`ModeID`);

--
-- Indizes für die Tabelle `RENTAL`
--
ALTER TABLE `RENTAL`
  ADD PRIMARY KEY (`RentalID`),
  ADD KEY `rental_areaid_fk` (`AreaID`),
  ADD KEY `rental_resortid_fk` (`ResortID`),
  ADD KEY `rental_addrid_fk` (`AddrID`);

--
-- Indizes für die Tabelle `RENTALPICTURES`
--
ALTER TABLE `RENTALPICTURES`
  ADD PRIMARY KEY (`RentalPicturesID`),
  ADD KEY `rentalpictures_rentalid_fk` (`RentalID`);

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
  MODIFY `AddrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT für Tabelle `ADMIN`
--
ALTER TABLE `ADMIN`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `GuestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `HOUSE`
--
ALTER TABLE `HOUSE`
  MODIFY `HouseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `MAINTENANCE`
--
ALTER TABLE `MAINTENANCE`
  MODIFY `MaintenanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `MODE`
--
ALTER TABLE `MODE`
  MODIFY `ModeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `PERSON`
--
ALTER TABLE `PERSON`
  MODIFY `PersonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT für Tabelle `PERSONMODE`
--
ALTER TABLE `PERSONMODE`
  MODIFY `PersonModeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT für Tabelle `RENTAL`
--
ALTER TABLE `RENTAL`
  MODIFY `RentalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `RENTALPICTURES`
--
ALTER TABLE `RENTALPICTURES`
  MODIFY `RentalPicturesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `RESORT`
--
ALTER TABLE `RESORT`
  MODIFY `ResortID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT für Tabelle `STRUCCHANGE`
--
ALTER TABLE `STRUCCHANGE`
  MODIFY `ChangeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `SURCHARGE`
--
ALTER TABLE `SURCHARGE`
  MODIFY `SurchargeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `ADMIN`
--
ALTER TABLE `ADMIN`
  ADD CONSTRAINT `admin_personid_fk` FOREIGN KEY (`PersonID`) REFERENCES `PERSON` (`PersonID`);

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
  ADD CONSTRAINT `emp_empid_fk` FOREIGN KEY (`Manager`) REFERENCES `EMP` (`EmpID`),
  ADD CONSTRAINT `emp_personid_fk` FOREIGN KEY (`PersonID`) REFERENCES `PERSON` (`PersonID`),
  ADD CONSTRAINT `emp_resortid_fk` FOREIGN KEY (`ResortID`) REFERENCES `RESORT` (`ResortID`);

--
-- Constraints der Tabelle `GUEST`
--
ALTER TABLE `GUEST`
  ADD CONSTRAINT `guest_personid_fk` FOREIGN KEY (`PersonID`) REFERENCES `PERSON` (`PersonID`);

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
-- Constraints der Tabelle `PERSON`
--
ALTER TABLE `PERSON`
  ADD CONSTRAINT `person_addrid_fk` FOREIGN KEY (`AddrID`) REFERENCES `ADDR` (`AddrID`);

--
-- Constraints der Tabelle `PERSONMODE`
--
ALTER TABLE `PERSONMODE`
  ADD CONSTRAINT `personmode_modeid_fk` FOREIGN KEY (`ModeID`) REFERENCES `MODE` (`ModeID`),
  ADD CONSTRAINT `personmode_personid_fk` FOREIGN KEY (`PersonID`) REFERENCES `PERSON` (`PersonID`);

--
-- Constraints der Tabelle `RENTAL`
--
ALTER TABLE `RENTAL`
  ADD CONSTRAINT `rental_addrid_fk` FOREIGN KEY (`AddrID`) REFERENCES `ADDR` (`AddrID`),
  ADD CONSTRAINT `rental_areaid_fk` FOREIGN KEY (`AreaID`) REFERENCES `AREA` (`AreaID`),
  ADD CONSTRAINT `rental_resortid_fk` FOREIGN KEY (`ResortID`) REFERENCES `RESORT` (`ResortID`);

--
-- Constraints der Tabelle `RENTALPICTURES`
--
ALTER TABLE `RENTALPICTURES`
  ADD CONSTRAINT `rentalpictures_rentalid_fk` FOREIGN KEY (`RentalID`) REFERENCES `RENTAL` (`RentalID`);

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
