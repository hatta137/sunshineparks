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

    /**
     * Author: Max Schelenz
     * This function returns the correct type of person by using the PersonID.
     * @return mixed
     */
    public function getChildClass() : mixed {
        if ($this->AccountType == "G") {
            return Guest::findByPersonId($this->PersonID);
        } else if ($this->AccountType == "E") {
            return Employee::findByPersonId($this->PersonID);
        } else if ($this->AccountType == "A") {
            return Admin::findByPersonId($this->PersonID);
        } else {
            return null;
        }
    }

    /**
     * This function returns the person which is matching to the given mail address.
     * @param string $mail
     * @return Person|null
     */
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

    /**
     * This function needs a PersonID to return the
     * ModeID.
     * @return int|null
     */

    public function getPersonModeID() :?int{
        $db = self::getDB();
        $stmt = $db->prepare('SELECT ModeID FROM PERSONMODE WHERE PersonID = ?');
        $stmt->execute([$this->PersonID]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return $row['ModeID'];
    }

        /*
        public static function newPerson("die ganzen Person daten aus der registierung view halt") :bool{
            return true; //true oder false je nachdem obs geklappt hat
        }

        */

    public static function newPerson(   $FirstName,
                                        $LastName,
                                        $Street,
                                        $HNumber,
                                        $ZipCode,
                                        $City,
                                        $State,
                                        $Tel,
                                        $Mail,
                                        $PasswordHash,
                                        $AccountType) : Person{
        try {
            $db = self::getDB();

            $stmtNewPerson = $db->prepare( //TODO Sql Function schreiben die NewPerson anlegt call p_NewPerson)

                // Insert Into Person -> alle Daten in die ParentClass einfügen
                //anschließend if Abfrage ob Guest
                //Datenbankfunktion Adress überprüfen ob es die schon gibt


        }catch (PDOException $e){
            echo $e;
        }

    }

}