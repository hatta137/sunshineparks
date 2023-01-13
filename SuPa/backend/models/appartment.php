<?php

class Appartment extends Model{
    public function __construct($appartmentId)
    {
        parent::__construct("APPARTMENT", "AppartmentID", $appartmentId);
    }


    public static function findByRentalId($rentalId) : ?Appartment {
        $db = getDB();

        echo $rentalId;
        $stmt = $db->prepare('SELECT AppartmentID FROM APPARTMENT WHERE RentalID = ?');
        $stmt->execute([$rentalId]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;

        }
        echo $row['AppartmentID'];
        return new Appartment($row['AppartmentID']);

    }
}