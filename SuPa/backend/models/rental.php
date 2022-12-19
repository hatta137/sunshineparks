<?php

class Rental extends Model{

    public function __construct($rentalId)
    {

        parent::__construct('RENTAL', $rentalId);
    }



    public static function getAllRental() : array
    {

        $db = self::getDB();

        $stmt = $db->prepare('SELECT * FROM RENTAL');
        $stmt->execute();

        $result = $stmt->fetchAll();
        $rentals = array();
        foreach ($result as $rental){



            $rentals [] = new Rental($rental['RentalID']);


        }

        return $rentals;
    }

    //TODO singleRental mit filter Eingaben suchen

    //public static function findByFilter(....): ?Rental {
    //    $db = self::getDB();
    //    $stmt = $db->prepare('SELECT * FROM RENTAL WHERE');
    //    $stmt->execute();

    //    $result[] = $stmt->fetchAll();
    //    $newRental = new Rental($result['RentalID']);
    //    return $newRental;
    //}



}
