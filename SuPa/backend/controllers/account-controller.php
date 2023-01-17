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
                    header('Location: index.php?page=error&view=noMode');
                    return false;
            }
        }else{
            //auf errorseite verweisen
            header('Location: index.php?page=authentication&view=authenticationGuest');
            return false;
        }
    }

    public function actionGuest(){
    if($_SESSION["loginType"] == "logout"){
        header('Location: index.php?page=authentication&view=authenticationGuest');
    }else if ($_SESSION["loginType"] != "guest"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionManager(){
        if($_SESSION["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_SESSION["loginType"] != "manager"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionAdmin(){
        if($_SESSION["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_SESSION["loginType"] != "admin"){
            header('Location: index.php?page=error&view=noAccess');
        }

    }

    public function actionCleaning(){
        if($_SESSION["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_SESSION["loginType"] != "cleaning"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionMaintenance(){
        if($_SESSION["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_SESSION["loginType"] != "maintenance"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionRental(){
        if($_SESSION["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_SESSION["loginType"] != "rental" & $_SESSION["loginType"] != "admin"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionBooking(){
        if($_SESSION["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_SESSION["loginType"] != "booking"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionDelete(){

    }

    public function actionLogout(){
        $_SESSION['loginType']="logout";
        unset($_SESSION['person']);
    }


}
