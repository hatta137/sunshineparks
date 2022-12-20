<?php
require_once __DIR__.'/../models/rental.php';
class RentalController extends Controller{

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

        $rentalFreeSeat = [];

        foreach ($rentals as $rental){
            $rentalFreeSeat[] = $rental->getTypeOfFreeSeat();
        }



        $this->_params['allRentals'] = $rentals;
        $this->_params['rentalTypes'] = $rentalTypes;
        $this->_params['rentalKitchen'] = $rentalKitchen;
        $this->_params['rentalFreeSeat'] = $rentalFreeSeat;

    }



    //TODO add new Object function -> siehe SQL procedure letztes Semester

}