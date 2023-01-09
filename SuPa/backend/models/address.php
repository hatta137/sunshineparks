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
    public static function findByPersonID($personID) : ?Address{
        $db = self::getDB();

        $stmt = $db->prepare('SELECT AddrID FROM PERSON WHERE PersonID = ?');
        $stmt->execute([$personID]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Address($row['AddrID']);


    }

}