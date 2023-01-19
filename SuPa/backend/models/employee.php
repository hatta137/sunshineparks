<?php
require_once __DIR__.'/../models/person.php';
require_once __DIR__.'/../models/personmode.php';
require_once __DIR__.'/../models/mode.php';


class Employee extends Model
{

    public function __construct($employeeId)
    {
        parent::__construct("EMP", "EmpID", $employeeId);

    }

    /**
     * Author: Max Schelenz
     * Finds an employee obejct by its personid.
     * @param $personId
     * @return Employee|null The employee object if it is found, or null if it is not found.
     */
    public static function findByPersonId($personId) : ?Employee {
        $db = getDB();

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

        $db = getDB();
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
        $db = getDB();

        $stmt = $db->prepare('SELECT * FROM EMP');
        $stmt->execute();
        $result = $stmt->fetchAll();

        $employees = array();

        foreach ($result as $rental){
            $employees [] = new Employee($rental['EmpID']);
        }
        return $employees;
    }


    public static function updateEmp(   $EmpID, $Manager, $Job, $ResortID) : ?Employee{

        $db = getDB();

        try {

            /* Update Employee-Data */
            $stmtEmployee = $db->prepare('UPDATE EMP SET
                                            Job = ?,
                                            ResortID = ?,
                                            Manager = ?
                                            WHERE EmpID = ?');
            $stmtEmployee->execute([$Job, $ResortID, $Manager, $EmpID]);

            return new Employee($EmpID);
        }
        catch (exception $e) {
            echo $e->getMessage();
            return new Employee($EmpID);
        }

    }

}