<?php
require_once __DIR__.'/../models/person.php';
class AccountController extends Controller {

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
