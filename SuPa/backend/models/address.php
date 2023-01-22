<?php

class Address extends Model {

    public function __construct($addressID)
    {
        parent::__construct("ADDR", "AddrID", $addressID);
    }

    /***
     * Author Hendrik Lendeckel
     * This function returns the appropriate address for the person using the PersonID.
     * @param $personID
     * @return Address|null
     */
    public static function findByPersonID($personID): ?Address {
        $db = getDB();

        try {

            $stmt = $db->prepare('SELECT AddrID FROM PERSON WHERE PersonID = ?');
            $stmt->execute([$personID]);
            $row = $stmt->fetch();
            return new Address($row['AddrID']);

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;

    }

    /**
     * Author Hendrik Lendeckel
     * This function updates the values in the ADDR table:
     * @param string $Street
     * @param string $HNumber
     * @param string $ZipCode
     * @param string $City
     * @param string $State
     * @return Address|null
     */
    public function updateAddress(string $Street, string $HNumber, string $ZipCode, string $City, string $State) :?Address{
        $db = getDB();

        try {
            $stmtAddress = $db->prepare('UPDATE ADDR SET
                                            Street = ?,
                                            HNumber = ?,
                                            ZipCode = ?,
                                            State = ?,
                                            City = ?
                                            WHERE AddrID = ?');

            $stmtAddress->execute([ $Street, $HNumber, $ZipCode, $State, $City, $this->AddrID]);

            return new Address($this->AddrID);

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;
    }




    /**
     * Author: Max Schelenz
     * Finds an address object by its street, house number, zip code, city, and state.
     * @param string $Street The street of the address.
     * @param string $HNumber The house number of the address.
     * @param string $ZipCode The zip code of the address.
     * @param string $City The city of the address.
     * @param string $State The state of the address.
     *
     * @return Address|null The Address object if it is found, or null if it is not found.
     */
    public static function findByValues(string $Street, string $HNumber, string $ZipCode, string $City, string $State): ?Address{
        $db = getDB();
        try {
            $stmt = $db->prepare('SELECT AddrID FROM ADDR WHERE Street = ? AND HNumber = ? AND ZipCode = ? AND City = ? AND State = ?');
            $stmt->execute([$Street, $HNumber, $ZipCode, $City, $State]);
            $row = $stmt->fetch();

            if (!$row) {
                return null;
            }

        }catch (Exception $e) {
                echo $e->getMessage();
            }

        return new Address($row['AddrID']);
    }

}