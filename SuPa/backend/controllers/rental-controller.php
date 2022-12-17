<?php
require_once __DIR__.'/../models/rental.php';
class RentalController extends Controller{

    public function actionAllRental(){

        $allRentals = Rental::getAllRental();

        $this->_params['allRentals'] = $allRentals;

    }


}