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
    public static function getResortByID($empID) : ?String{

        $db = self::getDB();
        $stmt = $db->prepare('SELECT Name FROM RESORT 
                                    JOIN EMP ON RESORT.ResortID = EMP.ResortID
                                    WHERE EMP.EmpID = ?');
        $stmt->execute([$empID]);
        $row = $stmt->fetch();

        if (!$row) {
            return 'kein Resort gefunden';
        }
        return $row['Name'];
    }

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
    
}