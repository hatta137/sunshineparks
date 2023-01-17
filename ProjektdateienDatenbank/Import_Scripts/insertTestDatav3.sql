/*-- In diesem Implementierungsskript werden die die CSV-Dateien via Bulk import eingebunden--
--------------------------------------------------------------------------------------------
*/

/*

 Der Import wurde auf einer Linux Machine durchgeführt. Deshalb fehlt LINES TERMINATED BY '\r\n'

*/

/* Import ADDR Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_ADDR.csv' 
INTO TABLE ADDR 
FIELDS TERMINATED BY ';';


/* Import AREA Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_AREA.csv' 
INTO TABLE AREA 
FIELDS TERMINATED BY ';';

/* Import RESORT Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_RESORT.csv' 
INTO TABLE RESORT 
FIELDS TERMINATED BY ';';

/* Import RENTAL Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_RENTAL.csv' 
INTO TABLE RENTAL 
FIELDS TERMINATED BY ';';


/* Import APPARTMENT Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_APPARTMENT.csv' 
INTO TABLE APPARTMENT 
FIELDS TERMINATED BY ';';


/* Import HOUSE Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_HOUSE.csv' 
INTO TABLE HOUSE 
FIELDS TERMINATED BY ';';
/* Import PERSON Daten*/
LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_PERSON.csv' 
INTO TABLE PERSON 
FIELDS TERMINATED BY ';';




/* Import GUEST Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_GUEST.csv' 
INTO TABLE GUEST 
FIELDS TERMINATED BY ';';


/* Import EMP Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_EMP.csv' 
INTO TABLE EMP 
FIELDS TERMINATED BY ';';



/* Import ADMIN Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_ADMIN.csv' 
INTO TABLE ADMIN 
FIELDS TERMINATED BY ';';

/* Import MODE Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_MODE.csv' 
INTO TABLE MODE 
FIELDS TERMINATED BY ';';

/* Import PERSONMODE Daten*/
LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_PERSONMODE.csv' 
INTO TABLE PERSONMODE 
FIELDS TERMINATED BY ';';

/* Import CLEANING Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_CLEANING.csv' 
INTO TABLE CLEANING 
FIELDS TERMINATED BY ';';


/* Import MAINTENANCE Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_MAINTENANCE.csv' 
INTO TABLE MAINTENANCE 
FIELDS TERMINATED BY ';';


/* Import CRAFTSERV Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_CRAFTSERV.csv' 
INTO TABLE CRAFTSERV 
FIELDS TERMINATED BY ';';


/* Import STRUCCHANGE Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_STRUCCHANGE.csv' 
INTO TABLE STRUCCHANGE 
FIELDS TERMINATED BY ';';






/* Import SEASON Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_SEASON.csv' 
INTO TABLE SEASON 
FIELDS TERMINATED BY ';';

/*------------ Bis hierhin 01.07.2022--------*/

/* Import SURCHARGE Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_SURCHARGE.csv' 
INTO TABLE SURCHARGE 
FIELDS TERMINATED BY ';';

/* Import BOOKING Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_BOOKING.csv' 
INTO TABLE BOOKING 
FIELDS TERMINATED BY ';';



/* Import BOOKINGDETAIL Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_BOOKINGDETAIL.csv' 
INTO TABLE BOOKINGDETAIL 
FIELDS TERMINATED BY ';';



/* Import RENTALPICTURES Daten */

LOAD DATA INFILE 'C:/xampp/htdocs/ws202223_gwpdwp_sunshineparks/ProjektdateienDatenbank/csv_import/SuPa_RENTALPICTURES.csv' 
INTO TABLE RENTALPICTURES 
FIELDS TERMINATED BY ';';


















