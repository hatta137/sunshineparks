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

    public static function getRentalType($renatlID) : string{

        $db = self::getDB();
        $stmt1 = $db->prepare('SELECT RentalID FROM APPARTMENT');
        $stmt2 = $db->prepare('SELECT RentalID FROM HOUSE');
        $stmt1->execute();
        $stmt2->execute();
        $appartments = $stmt1->fetchAll();
        $houses = $stmt2->fetchAll();



        foreach ($appartments as $appartment){


            if ($appartment['RentalID'] === $renatlID)
                return "Appartment ";
        }

        foreach ($houses as $house){
            if ($house['RentalID'] === $renatlID)
                return "House ";
        }
        return "No Rental Found ";


    }


    public static function getRentalArea($rentalID){

        $db = self::getDB();

        $stmt = $db->prepare('SELECT Name FROM AREA JOIN RENTAL ON AREA.AreaID = RENTAL.AreaID');
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;

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
