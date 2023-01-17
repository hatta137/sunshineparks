<?php
require_once __DIR__.'/../models/rental.php';
class RentalController extends Controller{

    /**
     *  Author: Dario Daßler
     *
     */
    //rightsCheck

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

        /** Arrays that Provides the different information  for each Rental */
        $rentalTypes = [];
        $rentalKitchen = [];
        $rentalOutdoorSeating = [];
        $rentalPicturePaths = [];

        foreach ($rentals as $rental){
            $rentalTypes[]          = $rental->getRentalType();
            $rentalKitchen[]        = $rental->getNumberOfKitchen();
            $rentalOutdoorSeating[] = $rental->getTypeOfRentalOutdoorSeating();
            $rentalPicturePaths[]   = $rental->getRentalPicturePath();
        }




        $this->_params['allRentals']            = $rentals;
        $this->_params['rentalTypes']           = $rentalTypes;
        $this->_params['rentalKitchen']         = $rentalKitchen;
        $this->_params['rentalOutdoorSeating']  = $rentalOutdoorSeating;
        $this->_params['rentalPicturePaths']    = $rentalPicturePaths;
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


        $rnumber   = $_POST['rnumber'];              // int
        $floor        = $_POST['floor'];             // int


        $freeseat = $_POST['freeseat'];

        if ($freeseat === "balcony")
        {
            $balcony = 'Y';
            $terrace = 'N';
        }
        else if($freeseat === "terrace")
        {
            $terrace = 'Y';
            $balcony = 'N';
        }

        if (isset($_POST['type'])){
            if ($_POST['type'] === "Apartment"){
                $terrace = 'N';
                $kitchen = 0;
                $isApartment = true;

            }
            if($_POST['type'] === "House"){
                $balcony = 'N';
                $rnumber = 0;
                $floor = 0;
                $isApartment = 0;
            }
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
                                        $rnumber,
                                        $floor,
                                        $terrace,
                                        $kitchen,
                                        $street,
                                        $houseNumber,
                                        $zipCode,
                                        $city,
                                        $state);





        $this->_params['newRental'] = $newRental;
        var_dump($newRental->getChildClass());
        if ($newRental->getChildClass() instanceof Appartment){
            $type = 'Apartment';

            $this->_params['balcony'] = $newRental->getChildClass()->Balcony;
            $this->_params['roomnumber'] = $newRental->getChildClass()->Roomnumber;
            $this->_params['floor'] = $newRental->getChildClass()->Floor;
            $this->_params['terrace'] = 0;
            $this->_params['kitchen'] = 0;

        }else if ($newRental->getChildClass() instanceof House){
            $type = 'House';
            $this->_params['terrace'] = $newRental->getChildClass()->Terrace;
            $this->_params['kitchen'] = $newRental->getChildClass()->Kitchen;
            $this->_params['balcony'] = 0;
            $this->_params['roomnumber'] = 0;
            $this->_params['floor'] = 0;
        }else
        {
            $type = 'undefined';
        }


        $this->_params['type'] = $type;

        $this->_params['address']   = Rental::getAddressFromRental($newRental->RentalID);





    }

    //TODO Check & Comments

    public function actionShowRenovation(){

        $show = $_GET['show'];
        $resortName = $_GET['resort'];

        $renovations = array();

        if ($show === 'all'){
            $renovations = Rental::getAllRenovation();
        }elseif ($show == 'byResort'){
            $renovations = Rental::getRenovationByResort($resortName);
        }



        $this->_params['renovations'] = $renovations;



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


        if ($newRenovation){

            $renovation = Rental::getLastRenovation();
            $this->_params['newRenovation'] = $renovation;

        }



    }

}