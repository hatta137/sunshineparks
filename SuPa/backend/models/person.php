<?php

require_once "admin.php";
require_once "employee.php";
require_once "guest.php";
require_once "address.php";

class Person extends Model
{

    public function __construct($personId)
    {
        parent::__construct('PERSON', 'PersonID', $personId);
    }


    /**
     * Author: Hendrik Lendeckel
     * This function updates the values in the PERSON table:
     *
     * @param $FirstName
     * @param $LastName
     * @param $DateOfBirth
     * @param $Tel
     * @param $Mail
     * @param $PasswordHash
     * @return Person|null
     */
    public function updatePerson($FirstName, $LastName, $DateOfBirth, $Tel, $Mail, $PasswordHash) :?Person{

        $db = getDB();

        try {
            $stmtPerson = $db->prepare('UPDATE PERSON SET 
                                        FirstName   = ?,
                                        LastName    = ?,
                                        DateOfBirth = ?,
                                        Tel         = ?,
                                        Mail        = ?,
                                        PasswordHash = ?
                                        WHERE PersonID = ?');
            $stmtPerson->execute([  $FirstName,
                $LastName,
                $DateOfBirth,
                $Tel,
                $Mail,
                $PasswordHash,
                $this->PersonID]);

            return new Person($this->PersonID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;
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

    // TODO Try Catch
    /**
     * Author Dario Dassler
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

    // TODO Try Catch
    /**
     * Author Dario Dassler
     * This function will return the Mode ID of the Person or Null
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

    /**
     * Author: Dario Daßler
     */

    public static function getPermission(int $modeID, string $action) :?string {
        $db = getDB();
        $stmt = $db->prepare('SELECT * FROM MODE WHERE ModeID = ?');
        $stmt->execute([$modeID]);
        $row = $stmt->fetch();

        if (!array_key_exists($action, $row)) {
            return null;
        }else {
            return $row[$action];
        }
}


    /**
     * Author: Max Schelenz
     * Adds a new person from type guest with all its values to ADDR, GUEST, PERSON and PERSONMODE.
     * @param $FirstName
     * @param $LastName
     * @param $DateOfBirth
     * @param $Tel
     * @param $Mail
     * @param $AccountType
     * @param $PasswordHash
     * @param $Street
     * @param $HNumber
     * @param $ZipCode
     * @param $City
     * @param $State
     * @param $ModeID
     * @return Person|null The person object if it is successfully added, or null if not.
     */


    public static function newPerson($FirstName, $LastName, $DateOfBirth, $Tel, $Mail, $AccountType, $PasswordHash,
                                     $Street, $HNumber, $ZipCode, $City, $State, $ModeID, $Job = null, $ResortID = null, $Manager = null) : ?Person
    {

        try {

            $db = getDB();
            $db->beginTransaction();

            $existingAddr = Address::findByValues($Street, $HNumber, $ZipCode, $City, $State);  //check if address is already existing, yes => use existing AddrID for this newPerson
            if ($existingAddr) {
                $AddrID = $existingAddr->AddrID;
            } else {
                $stmt = $db->prepare('INSERT INTO ADDR VALUES (NULL, ?, ?, ?, ?, ?)');
                $stmt->execute([$Street, $HNumber, $ZipCode, $City, $State]);
                $AddrID = $db->lastInsertId();
            }

            $stmt = $db->prepare('INSERT INTO PERSON VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$FirstName, $LastName, $DateOfBirth, $Tel, $Mail, $AddrID, $PasswordHash, $AccountType]);

            $PersonID = $db->lastInsertId();

            switch ($AccountType) {

                case "G":
                    $stmt = $db->prepare('INSERT INTO GUEST VALUES (NULL, ?)');
                    $stmt->execute([$PersonID]);
                    break;

                case "A":
                    $stmt = $db->prepare('INSERT INTO ADMIN VALUES (NULL, ?)');
                    $stmt->execute([$PersonID]);
                    break;

                case "E":
                    $stmt = $db->prepare('INSERT INTO EMP VALUES (NULL, ?, ?, ?, ?)');
                    $stmt->execute([$PersonID, $Job, $ResortID, $Manager]);
                    break;

                default:
                    return null;
            }

            $stmt = $db->prepare('INSERT INTO PERSONMODE VALUES (NULL, ?, ?)');
            $stmt->execute([$PersonID, $ModeID]);

            $db->commit();

            return new Person($PersonID);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }


    /**
     * Author: Max Schelenz (support by KevSTechSupport
     * @param $PersonID
     * @return bool
     */

    public static function deletePerson($PersonID) : bool {

        try {
            $db = getDB();
            $db->beginTransaction();

            $stmt = $db->prepare('DELETE FROM PERSON WHERE PersonID = ?');
            $stmt->execute([$PersonID]);

            $db->commit();

            return true;

        }catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }


}