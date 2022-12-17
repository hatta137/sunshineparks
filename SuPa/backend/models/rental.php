<?php

class Rental extends Model{

    public function __construct($rentalId)
    {
        //echo "constrr<br>";
        parent::__construct('RENTAL', $rentalId);
    }


    //TODO funktioniert nicht
    public static function getAllRental() : array
    {
        echo "getDB<br>";
        $db = self::getDB();

        $stmt = $db->prepare('SELECT * FROM RENTAL');
        $stmt->execute();
        echo "exe<br>";
        $result = $stmt->fetchAll();
        $rentals = array();
        foreach ($result as $rental){

            foreach ($rental as $items){
                echo $items."<br>";
                //$rentals [] = new Rental($items['RentalID']);
            }




        }
        echo $rentals;
        return $rentals;
    }

    public static function findById($id): ?Rental {
        $db = self::getDB();
        $stmt = $db->prepare('SELECT * FROM RENTAL WHERE');
        $stmt->execute();
        echo "exe<br>";
        $result[] = $stmt->fetchAll();
        $newRental = new Rental($result['RentalID']);
        return $newRental;
    }



}
