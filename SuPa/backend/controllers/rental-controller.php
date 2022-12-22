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


    public function actionNewRental(){

    }


    /**
     * Author: Hendrik Lendeckel
     * This function creates a new Rental
     * @return void
     */

    public function actionAddNewRental(){

        $maxVisitors  = $_POST['maxVisitors'];       // int
        $bedroom      = $_POST['bedroom'];           // int
        $bathroom     = $_POST['bathroom'];          // int
        $sqrMeter     = $_POST['sqrMeter'];          // int
        $status       = "C";
        $resortName   = $_POST['resort'];



        $kitchen      = $_POST['kitchen'];           // int
        $street       = $_POST['street'];            // string
        $houseNumber  = $_POST['houseNumber'];       // int
        $zipCode      = $_POST['zipCode'];           // string (max 5 zeichen)
        $city         = $_POST['city'];              // string
        $state        = "GER";

        $terrace      = $_POST['terrace'];           // enum ('Y','N')
        $roomnumber   = $_POST['roomnumber'];        // int
        $floor        = $_POST['floor'];             // int
        $balcony      = $_POST['balcony'];           // enum ('Y','N')

        $isApartment  = $_POST['isApartment'];       // bool // wird als auswahl übergeben -> checken was es ist

        if (isset($_POST['type'])){
            if ($_POST['type'] === "Apartment"){
                $terrace = 'N';
                $kitchen = 0;
                $isApartment = true;
            }
            if($_POST['type'] === "House"){
                $balcony = 'N';
                $roomnumber = 0;
                $floor = 0;
            }
        }




        $newRentalBool = Rental::newRental(
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

        if (!$newRentalBool){
            echo "Error";
        }

        $newRental = Rental::getLastRentalInResort($resortName);

        $this->_params['newRental'] = $newRental; // achtung boolean
    }

    //TODO Check & Comments

    public function actionShowRenovation(){

        $allRenovations = Rental::getAllRenovation();

        $this->_params['allRenovations'] = $allRenovations;



    }


    //TODO Check & Comments
    public function actionNewRenovation(){

        $rentalID               = $_GET['rentalID'];
        $startDate              = $_GET['startDate'];
        $plannedEndDate         = $_GET['plannedEndDate'];
        $description            = $_GET['description'];
        $plannedCosts           = $_GET['plannedCosts'];

        $companyName            = $_GET['companyName'];
        $craftservCategory      = $_GET['craftservCategory'];
        $phone                  = $_GET['phone'];
        $craftservStreet        = $_GET['craftservStreet'];
        $craftservHouseNumber   = $_GET['craftservHouseNumber'];
        $craftservZipCode       = $_GET['craftservZipCode'];
        $craftservCity          = $_GET['craftservCity'];
        $craftservState         = $_GET['craftservState'];



        $newRenovation = Rental::newRenovation(  $rentalID
                                                ,$startDate
                                                ,$plannedEndDate
                                                ,$description
                                                ,$plannedCosts
                                                ,$companyName
                                                ,$craftservCategory
                                                ,$phone
                                                ,$craftservStreet
                                                ,$craftservHouseNumber
                                                ,$craftservZipCode
                                                ,$craftservCity
                                                ,$craftservState      );

        $this->_params['newRenovation'] = $newRenovation; // achtung bool


    }

}