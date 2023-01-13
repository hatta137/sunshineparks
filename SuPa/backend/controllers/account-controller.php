<?php
require_once __DIR__.'/../models/person.php';
class AccountController extends Controller {

    public function actionGuest(){
    if($_COOKIE["loginType"] == "logout"){
        header('Location: index.php?page=authentication&view=authenticationGuest');
    }else if ($_COOKIE["loginType"] != "guest"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionManager(){
        if($_COOKIE["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_COOKIE["loginType"] != "manager"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionAdmin(){
        if($_COOKIE["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_COOKIE["loginType"] != "admin"){
            header('Location: index.php?page=error&view=noAccess');
        }

    }

    public function actionCleaning(){
        if($_COOKIE["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_COOKIE["loginType"] != "cleaning"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionMaintenance(){
        if($_COOKIE["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_COOKIE["loginType"] != "maintenance"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionRental(){
        if($_COOKIE["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_COOKIE["loginType"] != "rental"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionBooking(){
        if($_COOKIE["loginType"] == "logout"){
            header('Location: index.php?page=authentication&view=authenticationGuest');
        }else if ($_COOKIE["loginType"] != "booking"){
            header('Location: index.php?page=error&view=noAccess');
        }
    }

    public function actionDelete(){

    }

    public function actionLogout(){
        setcookie("loginType","logout");
        unset($_SESSION['person']);
    }


}
