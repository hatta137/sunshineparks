<?php
require_once __DIR__.'/../models/rental.php';
class RentalController extends Controller{

    public function actionAllRental(){



        $allRentals[] = Rental::getAllRental();

        /***
         * Needed Model functions:
         * - getRentalArea
         * - getRentalType(RentalID) : String ("House" oder "Appartment")
         *
         */
        //$allRentalAreas = array();
        //foreach ($allRentals as $rental){
        //    $allRentalAreas[] = Rental::getRentalArea($rental->RentalID);
        //}



        $this->_params['allRentals'] = $allRentals;


    }


    //TODO singleRental mit filter Eingaben suchen

    //public function actionSingleRental(){
    //    $requestId = $_GET['id'] ?? 0;
//
    //    if ($requestId != 0) {
    //        $rental = Rental::findById($requestId);
//
    //        if (is_null($rental)) {
    //            //header('Location: index.php?page=pages&view=error&error=404');
    //        }
//
    //        $this->_params['rental'] = $rental;
    //    } else {
    //        //header('Location: index.php?page=pages&view=error&error=404');
    //    }
//
    //}


    //TODO add new Object function -> siehe SQL procedure letztes Semester

}