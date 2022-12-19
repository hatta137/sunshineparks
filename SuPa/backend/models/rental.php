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
                return "Apartment ";
        }

        foreach ($houses as $house){
            if ($house['RentalID'] === $renatlID)
                return "Haus ";
        }
        return "No Rental Found ";


    }


    public static function getRentalArea($rentalID) :string{

        $db = self::getDB();

        $stmt = $db->prepare('SELECT Name FROM AREA JOIN RENTAL ON AREA.AreaID = RENTAL.AreaID');
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;

    }




    //TODO singleRental mit filter Eingaben suchen

    public static function findRentalsByFilter($resort, $startDate, $endDate, $numberOfGuests) :array{


        $db = self::getDB();

        // Setzt Funktion fn_GetResortID("ResortName") voraus

        $stmtGetResortID = $db->prepare('call fn_GetResortID("?")');
        $stmtGetResortID->execute($resort);
        $resortID = $stmtGetResortID->fetch();

        $stmtRentalsInResort = $db->prepare('SELECT * FROM RENTAL JOIN RESORT ON RENTAL.ResortID = RESORT.ResortID WHERE ResortID = $resortID');
        $stmtRentalsInResort->execute();
        $rentalsInResort = $stmtRentalsInResort->fetchAll();

        $stmtRentalsInBooking = $db->prepare('SELECT * FROM RENTAL 
                                                    JOIN BOOKINGDETAIL ON RENTAL.RentalID = BOOKINGDETAIL.RentalID 
                                                    JOIN BOOKING ON BOOKING.BookingID = BOOKINGDETAIL.BookingID 
                                                    JOIN RESORT ON RENTAL.ResortID = ?
                                                    WHERE RENTAL.MaxVisitor >= ?');

        foreach ($rentalsInResort as $rental){
            if ($rental['MaxVisitor'] >= $numberOfGuests){

            }
        }



        $resultRentals = array();

       // foreach ($rentals as $rental){

        //}
        return $resultRentals;

    }

    //public static function findByFilter(....): ?Rental {
    //    $db = self::getDB();
    //    $stmt = $db->prepare('SELECT * FROM RENTAL WHERE');
    //    $stmt->execute();

    //    $result[] = $stmt->fetchAll();
    //    $newRental = new Rental($result['RentalID']);
    //    return $newRental;
    //}



}
