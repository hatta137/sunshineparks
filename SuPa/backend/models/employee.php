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
    
}