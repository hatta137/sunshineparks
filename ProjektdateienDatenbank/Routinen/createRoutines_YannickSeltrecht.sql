delimiter $$
create or replace procedure p_getReinigungen(inEmpID int)
BEGIN

if (select CleaningID from CLEANING
where EmpID = inEmpid order by CleaningID limit 1) is NULL
then signal sqlstate '45000' set Message_text = 'Keine Reinigungen für diesen Mitarbeiter vorhanden!';
end if;

select Street, Hnumber, ZipCode, City, starttime, cleaningdate from ADDR join RENTAL on ADDR.AddrID = RENTAL.AddrID join CLEANING on CLEANING.RentalID = RENTAL.RentalID
where CLEANING.EmpID = inEmpid;

end $$
delimiter ;





create or replace view v_getReinigungsplan as
select FirstName, LastName, StartTime, CleaningDate, Street, Hnumber, ZipCode, City from ADDR join RENTAL on ADDR.AddrID = RENTAL.AddrID join
CLEANING on RENTAL.RentalID = CLEANING.RentalID 
join EMP on CLEANING.EmpID = EMP.EmpID;






