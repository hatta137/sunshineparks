<?php

class House extends Model{
    public function __construct($houseId)
    {
        parent::__construct("HOUSE", "HouseID", $houseId);
    }

    /**
     * Author Hendrik Lendeckel
     * This function returns the house from the HOUSE table that matches the rental.
     * @param $rentalId
     * @return House|null
     */
    public static function findByRentalId($rentalId) : ?House {

        $db = getDB();

        try {
            $stmt = $db->prepare('SELECT HouseID FROM HOUSE WHERE RentalID = ?');
            $stmt->execute([$rentalId]);
            $row = $stmt->fetch();

            return new House($row['HouseID']);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;

    }
}
