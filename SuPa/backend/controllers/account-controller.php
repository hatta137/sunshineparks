<?php
require_once __DIR__.'/../models/person.php';
class AccountController extends Controller {

    public function rightsCheck(): bool
    {
        if(isset($_SESSION['person'])){
            $person = new Person($_SESSION['person']);
            $personMode = $person->getPersonModeID();
            switch($this->_actionName){
                case "admin":
                    if($personMode == 1) return true;
                    else return false;
                case "cleaning":
                    if($personMode == 2) return true;
                    else return false;
                case "maintenance":
                    if($personMode == 3) return true;
                    else return false;
                case "manager":
                    if($personMode == 4) return true;
                    else return false;
                case "rental":
                    if($personMode == 5 || $personMode == 1) return true;
                    else return false;
                case "booking":
                    if($personMode == 6) return true;
                    else return false;
                case "guest":
                    if($personMode == 7) return true;
                    else return false;
                case "logout":
                    return true;
                default:
                    return false;
            }
        }else{

            header('Location: index.php?page=error&view=noMode');
            return false;
        }
    }

    public function actionGuest(){

    }

    public function actionManager(){

    }

    public function actionAdmin(){


    }

    public function actionCleaning(){

    }

    public function actionMaintenance(){

    }

    public function actionRental(){

    }

    public function actionBooking(){

    }

    public function actionDelete(){

    }

    public function actionLogout(){
        $_SESSION['loginType']="logout";
        $_SESSION['person'] = 88;
    }


}
