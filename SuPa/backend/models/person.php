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
        $db = getDB();
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
        $db = getDB();
        $stmt = $db->prepare('SELECT ModeID FROM PERSONMODE WHERE PersonID = ?');
        $stmt->execute([$this->PersonID]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return $row['ModeID'];
    }

        /*
        public static function newPerson("die ganzen Guest daten aus der registierung view halt") :bool{
            return true; //true oder false je nachdem obs geklappt hat
        }

        */

    /**
     * Author:
     * This function ...
     * @param $FirstName
     * @param $LastName
     * @param $DateOfBirth
     * @param $Tel
     * @param $Mail
     * @param $PasswordHash
     * @param $AccountType
     * @return bool
     */

    public static function newPerson($FirstName, $LastName, $DateOfBirth, $Tel, $Mail, $AccountType, $PasswordHash,
                                     $Street, $HNumber, $ZipCode, $City, $State, $ModeID) : ?Person
    {


        try {
            $db = self::getDB();

            $existingAddr = Address::findByValues($Street, $HNumber, $ZipCode, $City, $State);
            if ($existingAddr) {
                $AddrID = $existingAddr->AddrID;
            } else {
                $stmt = $db->prepare('INSERT INTO ADDR VALUES (NULL, ?, ?, ?, ?, ?)');
                $stmt->execute([$Street, $HNumber, $ZipCode, $City, $State]);
                $AddrID = $db->lastInsertId();
            }

            $stmt = $db->prepare('INSERT INTO PERSON VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$FirstName, $LastName, $DateOfBirth, $Tel, $Mail, $AddrID, $AccountType, $PasswordHash]);

            $PersonID = $db->lastInsertId();

            $stmt = $db->prepare('INSERT INTO GUEST VALUES (NULL, ?)');
            $stmt->execute([$PersonID]);

            $stmt = $db->prepare('INSERT INTO PERSONMODE VALUES (NULL, ?, ?)');
            $stmt->execute([$PersonID, $ModeID]);

            //Datenbankfunktion Adress überprüfen ob es die schon gibt

            $db->commit();

            return new Person($PersonID);

        }catch (PDOException $e){
            echo $e;
        }

    }



}