
/*

Routinen für das Projekt SunshineParks
Autor: Robin Harris
Gruppe PgB1

1. Funktion fn_GetChangeID
2. Prozedur p_NewRenovation
3.1 Prozedur p_changeRenovation_Description
3.2 Prozedur p_changeRenovation_EndDate
3.3 Prozedur p_changeRenovation_EndCosts
3.4 Prozedur p_changeRenovation_CraftServID
4. Sicht s_ShowRenovation


*/



-- Funktion fn_GetChangeID
DELIMITER $$
create or replace function fn_GetChangeID
( 
    inRentalID int, inStartDate date, inPlannedEndDate date, inPlannedCosts int, inCraftServID int
)
returns int
begin
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
DELIMITER ;

-- test
select fn_GetChangeID(17, '2020-08-01', '2020-08-12', "Test", 9000.00, 2) -- Ergebnis 4
select fn_GetChangeID(12, '2020-09-01', '2020-08-03', "Test", 9000.00, 2) -- Ergebnis -1




--2. Prozedur p_NewRenovation
DELIMITER $$
create or replace procedure p_NewRenovation (  IN inRentalID int, IN inStartDate date, IN inPlannedEndDate date, 
                                                IN inDescription varchar(200), IN inPlannedCosts int, IN inCraftServID int)
    
    begin
    declare inChangeID integer;
    declare StrucchangeExists CONDITION for SQLSTATE '45000';

     if fn_getChangeID(inRentalID, inStartDate, inPlannedEndDate, inPlannedCosts, inCraftServID)= -1
		THEN SIGNAL StrucchangeExists 
		SET MESSAGE_TEXT = 'Die eingegebene Renovierung wurde bereits erfasst';
    Else

    insert into STRUCCHANGE (RentalID, StartDate, PlannedEndDate, Description, PlannedCosts, CraftServID)
    values (inRentalID, inStartDate, inPlannedEndDate, inDescription, inPlannedCosts, inCraftServID);
	end if;

    SET inChangeID = (SELECT MAX(ChangeID) FROM strucchange);
	
    END$$
DELIMITER ;
   
   -- test
   call p_NewRenovation(17, '2020-08-01', '2020-08-12', "Test", 9000.00, 2) -- Fehlerausgabe
   call p_NewRenovation(16, '2020-03-04', '2020-04-12', "Test", 420.00, 4) 



-- 3. Prozeduren p_changeRenovation_...
-- 3.1 p_changeRenovation_Description
DELIMITER $$
create or replace procedure p_changeRenovation_Description(inChangeID int, newDescription varchar(200))
	begin
		update STRUCCHANGE
		set Description = newDescription
		where ChangeID = inChangeID;

    end $$
DELIMITER ;

--Test
call p_changeRenovation_Description(5, "Geländer Terasse") 



-- 3.2 p_changeRenovation_EndDate
DELIMITER $$
create or replace procedure p_changeRenovation_EndDate(inChangeID int, newEndDate date)
	begin
		update STRUCCHANGE
		set EndDate = newEndDate
		where ChangeID = inChangeID;

    end $$
DELIMITER ;

--Test
call p_changeRenovation_EndDate(5, '2020-10-12')


-- 3.3 p_changeRenovation_EndCosts
DELIMITER $$
create or replace procedure p_changeRenovation_EndCosts(inChangeID int, newEndCosts int)
	begin
		update STRUCCHANGE
		set EndCosts = newEndCosts
		where ChangeID = inChangeID;

    end $$
DELIMITER ;

--Test
call p_changeRenovation_EndCosts(5, 6000)


-- 3.4 p_changeRenovation_CraftServID
DELIMITER $$
create or replace procedure p_changeRenovation_CraftServID(inChangeID int, newCraftServID int)
	begin
		update STRUCCHANGE
		set CraftServID = newCraftServID
		where ChangeID = inChangeID;

    end $$
DELIMITER ;

--Test
call p_changeRenovation_CraftServID(5, 3)




-- 4. Sicht s_ShowRenovation
create or replace view s_ShowRenovation as
select *
from STRUCCHANGE
where EndDate is Null