<?php

class Appartment extends Model{
    public function __construct($appartmentId)
    {
        parent::__construct("APPARTMENT", "AppartmentID", $appartmentId);
    }

    /**
     * Returns an Appartment by its RentalID.
     * @param $rentalId
     * @return Appartment|null
     */

    public static function findByRentalId($rentalId) : ?Appartment {
        $db = getDB();


        $stmt = $db->prepare('SELECT AppartmentID FROM APPARTMENT WHERE RentalID = ?');
        $stmt->execute([$rentalId]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;

        }

        return new Appartment($row['AppartmentID']);

    }
}