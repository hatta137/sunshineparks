/*-- In diesem Implementierungsskript werden die die CSV-Dateien via Bulk import eingebunden--
--------------------------------------------------------------------------------------------
*/



/* Import ADDR Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_ADDR.csv'
    INTO TABLE ADDR
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';

/* Import AREA Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_AREA.csv'
INTO TABLE AREA
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n';

/* Import RESORT Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_RESORT.csv'
INTO TABLE RESORT 
FIELDS TERMINATED BY ';';

/* Import RENTAL Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_RENTAL.csv'
INTO TABLE RENTAL 
FIELDS TERMINATED BY ';';

/* Import APPARTMENT Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_APPARTMENT.csv'
INTO TABLE APPARTMENT 
FIELDS TERMINATED BY ';';

/* Import HOUSE Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_HOUSE.csv'
INTO TABLE HOUSE 
FIELDS TERMINATED BY ';';

/* Import MODE Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_MODE.csv'
    INTO TABLE MODE
    FIELDS TERMINATED BY ';';

/* Import PERSON Daten*/

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_PERSON.csv'
    INTO TABLE PERSON
    FIELDS TERMINATED BY ';';

/* Import PERSONMODE Daten*/

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_PERSONMODE.csv'
    INTO TABLE PERSONMODE
    FIELDS TERMINATED BY ';';

/* Import GUEST Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_GUEST.csv'
    INTO TABLE GUEST
    FIELDS TERMINATED BY ';';

/* Import ADMIN Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_ADMIN.csv'
    INTO TABLE ADMIN
    FIELDS TERMINATED BY ';';

/* Import EMP Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_EMP.csv'
    INTO TABLE EMP
    FIELDS TERMINATED BY ';';

/* Import CLEANING Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_CLEANING.csv'
INTO TABLE CLEANING
FIELDS TERMINATED BY ';';

/* Import MAINTENANCE Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_MAINTENANCE.csv'
INTO TABLE MAINTENANCE
FIELDS TERMINATED BY ';';

/* Import CRAFTSERV Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_CRAFTSERV.csv'
    INTO TABLE CRAFTSERV
    FIELDS TERMINATED BY ';';

/* Import STRUCCHANGE Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_STRUCCHANGE.csv'
INTO TABLE STRUCCHANGE
FIELDS TERMINATED BY ';';

/* Import SEASON Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_SEASON.csv'
    INTO TABLE SEASON
    FIELDS TERMINATED BY ';';

/* Import SURCHARGE Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_SURCHARGE.csv'
    INTO TABLE SURCHARGE
    FIELDS TERMINATED BY ';';

/* Import BOOKING Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_BOOKING.csv'
INTO TABLE BOOKING
FIELDS TERMINATED BY ';';

/* Import BOOKINGDETAIL Daten */

LOAD DATA INFILE 'C:/Users/Max/Desktop/CSV/SuPa_BOOKINGDETAIL.csv'
INTO TABLE BOOKINGDETAIL
FIELDS TERMINATED BY ';';














