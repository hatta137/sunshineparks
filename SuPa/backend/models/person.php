<?php

require_once "admin.php";
require_once "employee.php";
require_once "guest.php";

class Person extends Model
{

    public function __construct($personId)
    {
        parent::__construct('PERSON', 'PersonID', $personId);
    }

    // TODO: Add AccountType to database

    public function getChildClass() : mixed {
        if ($this->AccountType == "guest") {
            return Guest::findByPersonId($this->PersonID);
        } else if ($this->AccountType == "employee") {
            return Employee::findByPersonId($this->PersonID);
        } else if ($this->AccountType == "admin") {
            return Admin::findByPersonId($this->PersonID);
        } else {//noAccountType settet
            return null;
        }
    }

    public static function findByMail(string $mail) : ?Person {
        $db = self::getDB();
        $stmt = $db->prepare('SELECT PersonID FROM PERSON WHERE Mail = ?');
        $stmt->execute([$mail]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Person($row['PersonID']);
    }

    //ToDo public function findPersonByMail -> returns PersonID

    //

}