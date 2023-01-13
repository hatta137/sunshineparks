<?php
require_once __DIR__.'/../models/person.php';
class AuthenticationController extends Controller {

    private function alreadyLoggedIn(){
        if($_SESSION["loginType"]=="admin"){
            header('Location: index.php?page=account&view=admin');
        }else if($_SESSION["loginType"]=="guest"){
            header('Location: index.php?page=account&view=guest');
        }else if($_SESSION["loginType"]=="manager"){
            header('Location: index.php?page=account&view=manager');
        }else if($_SESSION["loginType"]=="rental"){
            header('Location: index.php?page=account&view=rental');
        }else if($_SESSION["loginType"]=="cleaning"){
            header('Location: index.php?page=account&view=cleaning');
        }else if($_SESSION["loginType"]=="maintenance"){
            header('Location: index.php?page=account&view=maintenance');
        }else if($_SESSION["loginType"]=="booking"){
            header('Location: index.php?page=account&view=booking');
        }
    }

    public function actionAuthenticationGuest(){
        $this->alreadyLoggedIn();
    }

    public function actionAuthenticationIntern(){
        $this->alreadyLoggedIn();
    }

//logiiiiiiiiic

    public function logicLogin()
    {
        $mail = $_POST['mail'];
        $person = Person::findByMail($mail);

        if (is_null($person)) {
            header('Location: index.php?page=error&view=unknownUser');
            return;
        }
        if (!password_verify($_POST['pwd'], $person->PasswordHash)) {
            header('Location: index.php?page=error&view=wrongPwd');
            return;
        }
        $personType = $person->AccountType;
        $loginType = $_POST['authType'];
        if ($personType == "G" && $loginType != "guest") {
            header('Location: index.php?page=error&view=noAccess');
            return;
        } else if (($personType == "E" || $personType == "A") && $loginType != "intern") {
            header('Location: index.php?page=error&view=noAccess');
            return;
        }
        $_SESSION['person'] = $person->PersonID;
        //$_SESSION['special'] = $person->getChildClass(); per personId in View gönnen
        $personMode = $person->getPersonModeID();

        switch ($personMode){
            case 1:
                $_SESSION['loginType']="admin";
                header('Location: index.php?page=account&view=admin');
                break;
            case 2:
                $_SESSION['loginType']="cleaning";
                header('Location: index.php?page=account&view=cleaning');
                break;
            case 3:
                $_SESSION['loginType']="maintenance";
                header('Location: index.php?page=account&view=maintenance');
                break;
            case 4:
                $_SESSION['loginType']="manager";
                header('Location: index.php?page=account&view=manager');
                break;
            case 5:
                $_SESSION['loginType']= "rental";
                header('Location: index.php?page=account&view=rental');
                break;
            case 6:
                $_SESSION['loginType']="booking";
                header('Location: index.php?page=account&view=booking');
                break;
            case 7:
                $_SESSION['loginType']="guest";
                header('Location: index.php?page=account&view=guest');
                break;
            default:
                header('Location: index.php?page=error&view=noMode');
                break;
        }

    }







}