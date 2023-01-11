<?php

class House extends Model{
    public function __construct($houseId)
    {
        parent::__construct("HOUSE", "HousetID", $houseId);
    }

    public static function findByRentalId($rentalId) : ?House {
        $db = getDB();

        $stmt = $db->prepare('SELECT HouseID FROM HOUSE WHERE RentalID = ?');
        $stmt->execute([$rentalId]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new House($row['HouseID']);
    }
}
