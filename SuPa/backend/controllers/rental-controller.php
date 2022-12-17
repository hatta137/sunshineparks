<?php
require_once __DIR__.'/../models/rental.php';
class RentalController extends Controller{

    public function actionAllRental(){


        echo "actionAllRental <br>";
        $allRentals[] = Rental::getAllRental();
        echo "getAllRental<br>";
        $this->_params['allRentals'] = $allRentals;
        echo "_paramsAllRental<br>";
    }

    public function actionSingleRental(){
        $requestId = $_GET['id'] ?? 0;

        if ($requestId != 0) {
            $rental = Rental::findById($requestId);

            if (is_null($rental)) {
                //header('Location: index.php?page=pages&view=error&error=404');
            }

            $this->_params['rental'] = $rental;
        } else {
            //header('Location: index.php?page=pages&view=error&error=404');
        }

    }


}