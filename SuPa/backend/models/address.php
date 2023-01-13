<?php

class Address extends Model {

    public function __construct($addressID)
    {
        parent::__construct("ADDR", "AddrID", $addressID);
    }

    /***
     * Autor Hendrik Lendeckel
     * @param $personID
     * @return Address|null
     */
    public static function findByPersonID($personID): ?Address {
        $db = getDB();

        $stmt = $db->prepare('SELECT AddrID FROM PERSON WHERE PersonID = ?');
        $stmt->execute([$personID]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Address($row['AddrID']);


    }

    /**
     * Author: Max Schelenz
     * Finds an address object by its street, house number, zip code, city, and state.
     *
     * @param string $Street The street of the address.
     * @param string $HNumber The house number of the address.
     * @param string $ZipCode The zip code of the address.
     * @param string $City The city of the address.
     * @param string $State The state of the address.
     *
     * @return Address|null The Address object if it is found, or null if it is not found.
     */
    public static function findByValues(string $Street, string $HNumber, string $ZipCode, string $City, string $State): ?Address {
        $db = getDB();

        $stmt = $db->prepare('SELECT AddrID FROM ADDR WHERE Street = ? AND HNumber = ? AND ZipCode = ? AND City = ? AND State = ?');
        $stmt->execute([$Street, $HNumber, $ZipCode, $City, $State]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Address($row['AddrID']);
    }

}