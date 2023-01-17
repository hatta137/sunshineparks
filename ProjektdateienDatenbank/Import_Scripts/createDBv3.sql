/*
-- Datenban: SuPa (Sunshine Parks)
-- erstellt am 20.06.2022
-- PG B1
-- Datenbank mit Tabellen
-- Datenbank Version
-- PHP-Version 8.1.6

------------------------------------------------------------
*/
DROP DATABASE IF EXISTS SunshineParksWeb;
CREATE DATABASE IF NOT EXISTS SunshineParksWeb 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;
USE SunshineParksWeb;

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle ADDR
--*/ 

DROP TABLE IF EXISTS ADDR;
CREATE TABLE IF NOT EXISTS ADDR
(
     AddrID	    integer	    not null AUTO_INCREMENT
    ,Street	    varchar(50)	not null
    ,HNumber	integer	    not null
    ,ZipCode	char(5)	    not null
    ,City	    varchar(50)	not null
    ,State	    varchar(50)	not null
    ,CONSTRAINT address_pk PRIMARY KEY (AddrID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle AREA
--*/


DROP TABLE IF EXISTS AREA;
CREATE TABLE IF NOT EXISTS AREA
(
     AreaID	integer	            not null    AUTO_INCREMENT
    ,Name	enum('M','O','C')	not null
    ,CONSTRAINT area_pk PRIMARY KEY (AreaID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle RESORT
--*/

DROP TABLE IF EXISTS RESORT;
CREATE TABLE IF NOT EXISTS RESORT
(
     ResortID	integer	    not null    AUTO_INCREMENT
    ,AddrID     integer     NOT NULL   
    ,Name	    varchar(50)	not null
    ,CONSTRAINT resort_pk PRIMARY KEY (ResortID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle RENTAL
--*/

DROP TABLE IF EXISTS RENTAL;
CREATE TABLE IF NOT EXISTS RENTAL
(
     RentalID	integer	                        not null AUTO_INCREMENT
    ,MaxVisitor	integer	                        not null
    ,Bedroom	integer	                        not null
    ,Bathroom	integer	                        not null
    ,SqrMeter	integer	                        not null
    ,BasicPrice	decimal(7,2)	                not null
    ,Status	    enum('R','N','C','D','M','B')	not null
    ,AreaID	    integer	                        not null
    ,ResortID	integer	                        not null
    ,AddrID     integer                         not null
    ,CONSTRAINT rental_pk PRIMARY KEY (RentalID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle APPARTMENT
--*/

DROP TABLE IF EXISTS APPARTMENT;
CREATE TABLE IF NOT EXISTS APPARTMENT
(
     AppartmentID	integer         not null AUTO_INCREMENT
    ,RentalID	    integer         not null
    ,Balcony	    enum('Y','N')   not null
    ,Roomnumber	    integer         not null
    ,Floor	        integer         not null
    ,CONSTRAINT appartment_pk PRIMARY KEY (AppartmentID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle HOUSE
--*/

DROP TABLE IF EXISTS HOUSE;
CREATE TABLE IF NOT EXISTS HOUSE
(
     HouseID	integer         not null AUTO_INCREMENT
    ,RentalID	integer         not null 
    ,Terrace	enum('Y','N')   not null
    ,Kitchen	integer         not null
    ,CONSTRAINT house_pk PRIMARY KEY (HouseID)
);


/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle CLEANING
--*/

DROP TABLE IF EXISTS CLEANING;
CREATE TABLE IF NOT EXISTS CLEANING
(
     CleaningID	        integer         not null        AUTO_INCREMENT
    ,RentalID	        integer         not null
    ,StartTime	        time            not null
    ,EndTime	        time            not null
    ,CleaningDate       DATE            NOT NULL
    ,EmpID	            integer         not null
    ,CONSTRAINT cleaning_pk PRIMARY KEY (CleaningID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle MAINTENANCE
--*/

DROP TABLE IF EXISTS MAINTENANCE;
CREATE TABLE IF NOT EXISTS MAINTENANCE
(
     MaintenanceID	    integer	        not null    AUTO_INCREMENT
    ,RentalID	        integer	        not null
    ,Description	    varchar(200)	not null
    ,MaintenanceDate    date            not null
    ,RepairProtocol     varchar(200)    null
    ,EmpID	            integer	        not null
    ,Active             enum('F','O')   not null
    ,CONSTRAINT maintenance_pk PRIMARY KEY (MaintenanceID)
);

/*
------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle STRUCCHANGE
--*/

DROP TABLE IF EXISTS STRUCCHANGE;
CREATE TABLE IF NOT EXISTS STRUCCHANGE
(
     ChangeID	    integer	        not null    AUTO_INCREMENT
    ,RentalID	    integer	        not null
    ,StartDate	    date	        not null
    ,PlannedEndDate	date	        not null
    ,EndDate	    date	        null
    ,Description	varchar(200)	not null
    ,PlannedCosts	decimal(10,2)	not null
    ,EndCosts	    decimal(10,2)	null
    ,CraftServID    INTEGER         NULL
    ,CONSTRAINT strucchange_pk PRIMARY KEY (ChangeID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle PERSON
--*/

DROP TABLE IF EXISTS PERSON;
CREATE TABLE IF NOT EXISTS PERSON
(
     PersonID       integer	        not null    AUTO_INCREMENT
    ,FirstName	    varchar(30)	    not null
    ,LastName	    varchar(50)	    not null
    ,DateOfBirth	date	        not null
    ,Tel	        varchar(50)	    not null
    ,Mail	        varchar(200)	not null
    ,AddrID         INTEGER         NOT NULL
    ,PasswordHash   varchar(200)    not null
    ,AccountType    enum('A','G','E') not null 
    ,CONSTRAINT person_pk PRIMARY KEY (PersonID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle EMP
--*/

DROP TABLE IF EXISTS EMP;
CREATE TABLE IF NOT EXISTS EMP
(
     EmpID	        integer	        not null    AUTO_INCREMENT
    ,PersonID       integer         not null
    ,Job	        varchar(50)	    not null
    ,ResortID       INTEGER 	    not null
    ,Manager	    integer	        null
    ,CONSTRAINT emp_pk PRIMARY KEY (EmpID)
);


/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle GUEST
--*/


DROP TABLE IF EXISTS GUEST;
CREATE TABLE IF NOT EXISTS GUEST
(
     GuestID	    integer	        not null    AUTO_INCREMENT
    ,PersonID       integer         not null
    ,CONSTRAINT guest_pk PRIMARY KEY (GuestID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle ADMIN
--*/


DROP TABLE IF EXISTS ADMIN;
CREATE TABLE IF NOT EXISTS ADMIN
(
     AdminID	    integer	    not null    AUTO_INCREMENT
    ,PersonID       integer     not null
    ,CONSTRAINT admin_pk PRIMARY KEY (AdminID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle PERSONMODE
--*/


DROP TABLE IF EXISTS PERSONMODE;
CREATE TABLE IF NOT EXISTS PERSONMODE
(
     PersonModeID    integer                                 not null    AUTO_INCREMENT
    ,PersonID       integer                                 not null    
    ,ModeID         integer                                 not null
    ,CONSTRAINT personmode_pk PRIMARY KEY (PersonModeID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle BOOKING
--*/


DROP TABLE IF EXISTS BOOKING;
CREATE TABLE IF NOT EXISTS BOOKING
(
     BookingID	        integer	            not null    AUTO_INCREMENT
    ,DateBooking	    date	            not null
    ,StartDateRent	    date	            not null
    ,EndDateRent	    date	            not null
    ,PaymentStatus	    enum('O','P','C')	not null
    ,GuestID            INTEGER             not null
    ,CONSTRAINT booking_pk PRIMARY KEY (BookingID)
);


/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle BOOKINGDETAIL
--*/


DROP TABLE IF EXISTS BOOKINGDETAIL;
CREATE TABLE IF NOT EXISTS BOOKINGDETAIL
(
     BookingDetailID	integer	            not null    AUTO_INCREMENT
    ,BookingID	        integer	            not null
    ,RentalID	        integer	            not null
    ,SurchargeID	    integer	            not null
    ,EndPrice	        decimal(10,2)       not null
    ,Status	            enum('R','B','C')	not null
    ,CONSTRAINT bookingdetail_pk PRIMARY KEY (BookingDetailID)
);


/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle SURCHARGE
--*/


DROP TABLE IF EXISTS SURCHARGE;
CREATE TABLE IF NOT EXISTS SURCHARGE
(
     SurchargeID	        integer	        not null    AUTO_INCREMENT
    ,Percent	            decimal(5,2)	not null
    ,SeasonID	            integer	        not null
    ,AreaID	                integer	        not null
    ,NumberOfVisitors	    integer	        not null
    ,CONSTRAINT surcharge_pk PRIMARY KEY (SurchargeID)
);

/*------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle SEASON
--*/

DROP TABLE IF EXISTS SEASON;
CREATE TABLE IF NOT EXISTS SEASON
(
     SeasonID	integer	            not null    
    ,Name	    enum('O','S','W')	not null
    ,CONSTRAINT season_pk PRIMARY KEY (SeasonID)
);




/*
------------------------------------------------------------
--
-- Tabellenstruktur für Tabelle CRAFTSERV
--
*/

DROP TABLE IF EXISTS CRAFTSERV;
CREATE TABLE IF NOT EXISTS CRAFTSERV
(
     CraftServID	integer	        not null
    ,CompName	    varchar(50)	    not null
    ,Category	    varchar(200)	not null
    ,AddrID	        integer	        not null
    ,Tel	        varchar(50)	    not null
    ,Mail	        varchar(200)	not null
    ,CONSTRAINT craftserv_pk PRIMARY KEY (CraftServID)
);



DROP TABLE IF EXISTS MODE;
CREATE TABLE IF NOT EXISTS MODE
(
     ModeID	                    integer	        not null        AUTO_INCREMENT
    ,Role	                    enum('A','C','M','Mgr','R','B','G')	not null
    ,AddNewEmp	                enum('Y','N')	not null
    ,AddNewGuest	            enum('Y','N')	not null
    ,CreateCleaningPlan	        enum('Y','N')	not null
    ,ReportDamageRepair	        enum('Y','N')	not null
    ,ShowRepair	                enum('Y','N')	not null
    ,EditRepair	                enum('Y','N')	not null
    ,AddRental	                enum('Y','N')	not null
    ,EditRental	                enum('Y','N')	not null
    ,DeactivateRental	        enum('Y','N')	not null
    ,ShowRental	                enum('Y','N')	not null
    ,AddRenovation	            enum('Y','N')	not null
    ,EditRenovation	            enum('Y','N')	not null
    ,ShowRenovation	            enum('Y','N')	not null
    ,AddNewBuilding	            enum('Y','N')	not null
    ,EditNewBuilding	        enum('Y','N')	not null
    ,CloseNewBuildingProcess	enum('Y','N')	not null
    ,ShowNewBuildingRental	    enum('Y','N')	not null
    ,CONSTRAINT mode_pk PRIMARY KEY (ModeID)

);

DROP TABLE IF EXISTS RENTALPICTURES;
CREATE TABLE IF NOT EXISTS RENTALPICTURES
(
     RentalPicturesID	integer	        not null        AUTO_INCREMENT
    ,RentalID	        integer	        not null
    ,Path	            Varchar(300)	not null
    ,Description	    Varchar(200)	null

    ,CONSTRAINT rentalpicture_pk PRIMARY KEY (RentalPicturesID)
);




/*
----------------------------------------------------------------------------------------------
-- Ab hier folgen die Fremdschlüssel. Diese wurden in Step 2 der Implementierung hinterlegt --
----------------------------------------------------------------------------------------------
*/



/*
 FOREIGN KEY für RENTAL auf AreaID, ResortID, AddrID
*/ 

ALTER TABLE RENTAL
 ADD CONSTRAINT rental_areaid_fk    FOREIGN KEY (AreaID)
 REFERENCES AREA(AreaID)
,ADD CONSTRAINT rental_resortid_fk  FOREIGN KEY (ResortID)
 REFERENCES RESORT(ResortID)
,ADD CONSTRAINT rental_addrid_fk    FOREIGN KEY (AddrID)
 REFERENCES ADDR(AddrID)

;

/*
 FOREIGN KEY für APPARTMENT auf RentalID
*/ 

ALTER TABLE APPARTMENT
 ADD CONSTRAINT appartment_rentalid_fk FOREIGN KEY (RentalID)
 REFERENCES RENTAL(RentalID)
;

/*
 FOREIGN KEY für HOUSE auf RentalID
*/ 

ALTER TABLE HOUSE
 ADD CONSTRAINT house_rentalid_fk FOREIGN KEY (RentalID)
 REFERENCES RENTAL(RentalID)
;

/*
 FOREIGN KEY für CLEANING auf RentalID, EmpID
*/ 

ALTER TABLE CLEANING
 ADD CONSTRAINT cleaning_rentalid_fk FOREIGN KEY (RentalID)
 REFERENCES RENTAL(RentalID)
,ADD CONSTRAINT cleaning_empid_fk FOREIGN KEY (EmpID)
 REFERENCES EMP(EmpID)
;

/*
 FOREIGN KEY für MAINTENANCE auf RentalID, EmpID
*/ 

ALTER TABLE MAINTENANCE
 ADD CONSTRAINT maintenance_rentalid_fk FOREIGN KEY (RentalID)
 REFERENCES RENTAL(RentalID)
,ADD CONSTRAINT maintenance_empid_fk FOREIGN KEY (EmpID)
 REFERENCES EMP(EmpID)
;

/*
 FOREIGN KEY für STRUCCHANGE auf RentalID, CraftServID
*/ 

ALTER TABLE STRUCCHANGE
 ADD CONSTRAINT strucchange_rentalid_fk FOREIGN KEY (RentalID)
 REFERENCES RENTAL(RentalID)
,ADD CONSTRAINT strucchange_craftservid_fk FOREIGN KEY (CraftServID)
 REFERENCES CRAFTSERV(CraftServID)
;

/*
    FOREIGN KEY für PERSON auf ADDR (AddrID)
*/

ALTER TABLE PERSON

ADD CONSTRAINT person_addrid_fk FOREIGN KEY (AddrID)
 REFERENCES ADDR(AddrID);


/*
 FOREIGN KEY für EMP auf EmpID (Manager), PERSON (PersonID)
*/ 

ALTER TABLE EMP

ADD CONSTRAINT emp_personid_fk FOREIGN KEY (PersonID)
REFERENCES PERSON(PersonID)
,ADD CONSTRAINT emp_resortid_fk FOREIGN KEY (ResortID)
 REFERENCES RESORT(ResortID)
,ADD CONSTRAINT emp_empid_fk FOREIGN KEY (Manager)
 REFERENCES EMP(EmpID)

;

/*
 FOREIGN KEY für GUEST auf PersonID
*/ 

ALTER TABLE GUEST
ADD CONSTRAINT guest_personid_fk FOREIGN KEY (PersonID)
REFERENCES PERSON(PersonID)


;

/*
    FOREIGN KEY für ADMIN auf PersonID
*/

ALTER TABLE ADMIN
ADD CONSTRAINT admin_personid_fk FOREIGN KEY (PersonID)
REFERENCES PERSON(PersonID);


/*
    FOREIGN KEY für PERSONMODE
*/

ALTER TABLE PERSONMODE
ADD CONSTRAINT personmode_personid_fk FOREIGN KEY (PersonID)
REFERENCES PERSON(PersonID)
,ADD CONSTRAINT personmode_modeid_fk FOREIGN KEY (ModeID)
REFERENCES MODE(ModeID);


/*
 FOREIGN KEY für BOOKING auf VisitorID, GuestID
*/ 

ALTER TABLE BOOKING

ADD CONSTRAINT booking_guestid_fk FOREIGN KEY (GuestID)
 REFERENCES GUEST(GuestID)
;


/*
 FOREIGN KEY für BOOKINGDETAIL auf BookingID, RentalID, SurchargeID
*/ 

ALTER TABLE BOOKINGDETAIL
 ADD CONSTRAINT bookingdetail_bookingid_fk FOREIGN KEY (BookingID)
 REFERENCES BOOKING(BookingID)
,ADD CONSTRAINT bookingdetail_rentalid_fk FOREIGN KEY (RentalID)
 REFERENCES RENTAL(RentalID)
 ,ADD CONSTRAINT bookingdetail_surchargeid_fk FOREIGN KEY (SurchargeID)
 REFERENCES SURCHARGE(SurchargeID)
;

/*
 FOREIGN KEY für SURCHARGE auf SeasonID, AreaID, VisitorID
*/ 

ALTER TABLE SURCHARGE
 ADD CONSTRAINT surcharge_seasonid_fk FOREIGN KEY (SeasonID)
 REFERENCES SEASON(SeasonID)
,ADD CONSTRAINT surcharge_areaid_fk FOREIGN KEY (AreaID)
 REFERENCES AREA(AreaID)

;

/*
 FOREIGN KEY für RESORT auf AddrID
*/ 

ALTER TABLE RESORT
 ADD CONSTRAINT resort_addrid_fk FOREIGN KEY (AddrID)
 REFERENCES ADDR(AddrID)
;


/*
 FOREIGN KEY für CRAFTSERV auf AddrID
*/ 

ALTER TABLE CRAFTSERV
 ADD CONSTRAINT craftserv_addrid_fk FOREIGN KEY (AddrID)
 REFERENCES ADDR(AddrID)
;

/*
 FOREIGN KEY für RENTALPICTURES auf RentalID
*/ 

ALTER TABLE RENTALPICTURES
 ADD CONSTRAINT rentalpictures_rentalid_fk FOREIGN KEY (RentalID)
 REFERENCES RENTAL(RentalID)
;