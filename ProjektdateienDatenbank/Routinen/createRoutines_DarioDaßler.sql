-- Lets Go!!
Instandhaltungs Prozeduren
verfasser: Dario Daßler

/*
 Sichten

    1.) Aktueller Auftrag *
    2.) alle aktuelle Aufträge *

Funktionen

    1.) best. Auftrag einsehen
    2.) Aufträge für einen mitarbeiter (aktuelle)
    3.) get RentalResort ID *
    //alle für einen mitarbeiter (protokoll)

Prozeduren

    1.) Auftrag anlegen *
        benötigte Funktionen:
        - Mitarbeiter und Zeit zuweisung *
        - Objektstaus ändern *
        - get rentalResortID *
    2.) Objektstatus ändern *
    3.) Auftrag bearbeiten
        3.1) Löschen
        3.2) Beschreibung ändern
        3.3) Protokoll verfassen *
        3.4) Auftrag abschließen *

    abgehakt -> *
*/



create or replace view v_getAllOpenMaintenanceAuftrag as
select MaintenanceID, RentalID, Description, MaintenanceDate, RepairProtocol, EmpID from MAINTENANCE
where active = 'O'; 

create or replace view v_getAllMaintenanceRentals as
select RentalID from RENTAL
where Status = 'M';

create or replace view v_getActualMaintenanceAuftrag as
select MaintenanceID, RentalID, Description, MaintenanceDate, RepairProtocol, EmpID from MAINTENANCE
where Active = 'O'
and CURRENT_DATE = MaintenanceDate;


DELIMITER $$
create or replace procedure p_ChangeObjektstatus(inRentalID int, NewObjStatus varchar(1))
	begin
        update RENTAL
        set  Status = NewObjStatus
        where RentalID = inRentalID;
    end $$
DELIMITER ;

DELIMITER $$
create or replace function fn_GetRentalResortID(inRentalID int)
returns int
    begin
        declare outResortID int;
        select ResortID into outResortID from RENTAL where RentalID = inRentalID;
        return outResortID;
    end $$
DELIMITER ;

DELIMITER $$
create or replace procedure p_FinishMaintenance(inMaintenanceID int)
    begin
        declare inRentalID int;
        select RentalID into inRentalID from MAINTENANCE where MaintenanceID = inMaintenanceID;
        call p_ChangeObjektstatus(inRentalID, 'C');
        update MAINTENANCE 
        set active ='F'
        where MaintenanceID = inMaintenanceID;
    end $$
DELIMITER ;

DELIMITER $$
create or replace procedure p_GetFreeMaintenanceEmp(IN inRentalID int, OUT outEmpID int, OUT outDate date)
    begin
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
            
            set vAuftragStatus = (select active from MAINTENANCE
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

    end $$
DELIMITER ;

DELIMITER $$
create or replace function fn_IsExistingRental(inRentalID int)
returns int
    begin
        return (select rentalID from RENTAL where RentalID = inRentalID) is not null;
    end $$
DELIMITER ;

DELIMITER $$
create or replace procedure p_NewMaintenance(IN inRentalID int, IN inDescription varchar(200))
    begin
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
    end $$
DELIMITER ;

DELIMITER $$
create or replace procedure p_WriteRepairProtocol(inMaintenanceID int, protocol varchar(200))
    begin
        update MAINTENANCE
        set RepairProtocol = protocol
        where MaintenanceID = inMaintenanceID;
    end $$
DELIMITER ;

-- Testfälle
-- /T70.1/
call p_NewMaintenance(8,'Klima Defekt');

declare vEmpID int;
declare vDate date;
-- /T70.1.1
call p_GetFreeMaintenanceEmp(8,vEmpID,vDate);
/*
     vEmpID => 10
     vDate => aktuelles Datum
*/

-- /T70.1.2
select fn_GetRentalResortID(5); -- => 10

-- /T70.1.3
select fn_IsExistingRental(20); -- => 1 
select fn_IsExistingRental(99); -- => 0

-- /T70.1.4
call p_ChangeObjektstatus(10,'M');

-- /T70.2.3
call p_WriteRepairProtocol(6, 'Kühlwasser gewechselt');

-- /T70.2.4
call p_FinishMaintenance(6);