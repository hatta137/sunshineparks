<?php
require_once __DIR__.'/../models/rental.php';
class RentalController extends Controller{


    /**
     * Author: Hendrik Lendeckel
     * Depending on the $show, this function shows all rentals
     * or only certain rentals depending on the filter options set
     *
     */
    public function actionShowRental(){

        $show = $_GET['show'];
        $rentals = array();
        if ($show === 'all'){
            $rentals = Rental::getAllRental();

        } elseif ($show = 'filter'){
            $rentals = Rental::findRentalsByFilter($_GET['resort'], $_GET['startDate'], $_GET['endDate'], $_GET['numberOfGuests']);
        }



        /** Array that Provides the TypeOf and Location String for each Rental */
        $rentalTypes = [];
        foreach ($rentals as $rental){
            $rentalTypes[] = $rental->getRentalType();
        }



        /** Array that Provides the Number of Kitchens in a Rental */
        $rentalKitchen = [];
        foreach ($rentals as $rental){
            $rentalKitchen[] = $rental->getNumberOfKitchen();
        }



        /** Array that Provides the Type of FreeSeat (Apartment -> Balcony Y/N or House -> Terrace Y/N in a Rental */
        $rentalFreeSeat = [];
        foreach ($rentals as $rental){
            $rentalFreeSeat[] = $rental->getTypeOfFreeSeat();
        }



        $this->_params['allRentals'] = $rentals;
        $this->_params['rentalTypes'] = $rentalTypes;
        $this->_params['rentalKitchen'] = $rentalKitchen;
        $this->_params['rentalFreeSeat'] = $rentalFreeSeat;

    }


    /**
     * Author: Hendrik Lendeckel
     * This function creates a new Rental
     * @return void
     */

    public function actionNewRental(){

        $maxVisitors  = $_GET['maxVisitors'];       // int
        $bedroom      = $_GET['bedroom'];           // int
        $bathroom     = $_GET['bathroom'];          // int
        $sqrMeter     = $_GET['sqrMeter'];          // int
        $status       = $_GET['status'];            // enum ('R','N','C','D','M','B')
        $isApartment  = $_GET['isApartment'];       // bool
        $resortName   = $_GET['resortName'];        // string
        $balcony      = $_GET['balcony'];           // enum ('Y','N')
        $roomnumber   = $_GET['roomnumber'];        // int
        $floor        = $_GET['floor'];             // int
        $terrace      = $_GET['terrace'];           // enum ('Y','N')
        $kitchen      = $_GET['kitchen'];           // int
        $street       = $_GET['street'];            // string
        $houseNumber  = $_GET['houseNumber'];       // int
        $zipCode      = $_GET['zipCode'];           // string (max 5 zeichen)
        $city         = $_GET['city'];              // string
        $state        = $_GET['state'];             // string


        /** check if Apartment and correct any incorrect entries */
        if ($isApartment){
            $kitchen = 0;
            $terrace = 'N';
        }else{
            $balcony = 'N';
            $roomnumber = 0;
            $floor = 0;
        }


        $newRental = Rental::newRental(
            $maxVisitors,
            $bedroom,
            $bathroom,
            $sqrMeter,
            $status,
            $isApartment,
            $resortName,
            $balcony,
            $roomnumber,
            $floor,
            $terrace,
            $kitchen,
            $street,
            $houseNumber,
            $zipCode,
            $city,
            $state);


        $this->_params['newRental'] = $newRental; // achtung boolean
    }

}