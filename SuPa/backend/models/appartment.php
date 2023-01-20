<?php

class Appartment extends Model{
    public function __construct($appartmentId)
    {
        parent::__construct("APPARTMENT", "AppartmentID", $appartmentId);
    }

    /**
     * Autor Hendrik Lendeckel
     * This function returns the apartment from the APARTMENT table that matches the rental.
     * @param $rentalId
     * @return Appartment|null
     */
    public static function findByRentalId($rentalId) : ?Appartment {
        $db = getDB();

        try {
            $stmt = $db->prepare('SELECT AppartmentID FROM APPARTMENT WHERE RentalID = ?');
            $stmt->execute([$rentalId]);
            $row = $stmt->fetch();

            return new Appartment($row['AppartmentID']);

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;

    }
}