<?php

class Employee extends Model
{

    public function __construct($employeeId)
    {
        parent::__construct("EMP", "EmpID", $employeeId);

    }

    public static function findByPersonId($personId) : ?Employee {
        $db = self::getDB();

        $stmt = $db->prepare('SELECT EmpID FROM EMP WHERE PersonID = ?');
        $stmt->execute([$personId]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Employee($row['EmpID']);
    }


    /***
     * Autor Hendrik Lendeckel
     * @param $empID
     * @return String|null
     */
    public function getResort() : ?String{

        $db = self::getDB();
        $stmt = $db->prepare('SELECT Name FROM RESORT 
                                    JOIN EMP ON RESORT.ResortID = EMP.ResortID
                                    WHERE EMP.EmpID = ?');
        $stmt->execute([$this->EmpID]);
        $row = $stmt->fetch();

        if (!$row) {
            return 'kein Resort gefunden';
        }
        return $row['Name'];
    }


    /***
     * Autor Hendrik Lendeckel
     * @return array|null
     */
    public static function getAllEmployees() : ?array{
        $db = self::getDB();

        $stmt = $db->prepare('SELECT * FROM EMP');
        $stmt->execute();
        $result = $stmt->fetchAll();

        $employees = array();

        foreach ($result as $rental){
            $employees [] = new Employee($rental['EmpID']);
        }
        return $employees;
    }

    public static function updateEmp(   $EmpID,
                                        $FirstName,
                                        $LastName,
                                        $DateOfBirth,
                                        $Tel,
                                        $Mail,
                                        $Manager,
                                        $Job,
                                        $Street,
                                        $HNumber,
                                        $ZipCode,
                                        $State,
                                        $City,
                                        $Resort) : ?Employee{

        $emp = new Employee($EmpID);
        $personID = $emp->PersonID;

        $db = self::getDB();

        $stmtPerson = $db->prepare('UPDATE Person SET 
                                        FirstName   = ?,
                                        LastName    = ?,
                                        DateOfBirth = ?,
                                        Tel         = ?,
                                        Mail        = ?,
                                        Manager     = ?
                                        WHERE PersonID = ?');
        $stmtPerson->execute([  $FirstName,
                                $LastName,
                                $DateOfBirth,
                                $Tel,
                                $Mail,
                                $Manager,
                                $personID]);

        $stmtEmployee = $db->prepare('UPDATE EMP SET
                                            Job = ?,
                                            Resort = ?,
                                            Manager = ?');
        $stmtEmployee->execute([    $Job,
                                    $Resort,
                                    $Manager]);


        $stmtAddress = $db->prepare('UPDATE ADDR SET
                                            Street = ?,
                                            HNumber = ?,
                                            ZipCode = ?,
                                            State = ?,
                                            City = ?');

        $stmtAddress->execute([ $Street,
                                $HNumber,
                                $ZipCode,
                                $State,
                                $City]);

        return $emp;
    }
    
}