<?php
require_once __DIR__.'/../models/person.php';
class AuthenticationController extends Controller {



    public function actionAuthenticationGuest(){
        if($_COOKIE["loginType"]=="admin"){
            header('Location: index.php?page=account&view=admin');
        }else if($_COOKIE["loginType"]=="guest"){
            header('Location: index.php?page=account&view=guest');
        }else if($_COOKIE["loginType"]=="manager"){
            header('Location: index.php?page=account&view=manager');
        }else if($_COOKIE["loginType"]=="rental"){
            header('Location: index.php?page=account&view=rental');
        }else if($_COOKIE["loginType"]=="cleaning"){
            header('Location: index.php?page=account&view=cleaning');
        }else if($_COOKIE["loginType"]=="maintanance"){
            header('Location: index.php?page=account&view=maintanance');
        }else if($_COOKIE["loginType"]=="booking"){
            header('Location: index.php?page=account&view=guest');
        }
    }

    public function actionAuthenticationIntern(){
        if($_COOKIE["loginType"]=="admin"){
            header('Location: index.php?page=account&view=admin');
        }else if($_COOKIE["loginType"]=="guest"){
            header('Location: index.php?page=account&view=guest');
        }else if($_COOKIE["loginType"]=="manager"){
            header('Location: index.php?page=account&view=manager');
        }else if($_COOKIE["loginType"]=="rental"){
            header('Location: index.php?page=account&view=rental');
        }else if($_COOKIE["loginType"]=="cleaning"){
            header('Location: index.php?page=account&view=cleaning');
        }else if($_COOKIE["loginType"]=="maintanance"){
            header('Location: index.php?page=account&view=maintanance');
        }else if($_COOKIE["loginType"]=="booking"){
            header('Location: index.php?page=account&view=guest');
        }
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
        $_SESSION['person'] = $person;
        $_SESSION['special'] = $person->getChildClass();
        $personMode = $person->getPersonModeID();
        //personmode in _params
        if ($personType === "G") {
            header('Location: index.php?page=account&view=guest');
            setcookie("loginType","guest");
        } else if ($personType === "E") {
            switch ($personMode){
                case 1:
                    setcookie("loginType","admin");
                    header('Location: index.php?page=account&view=admin');
                    break;
                case 2:
                    setcookie("loginType","cleaning");
                    header('Location: index.php?page=account&view=cleaning');
                    break;
                case 3:
                    setcookie("loginType","maintanance");
                    header('Location: index.php?page=account&view=maintanance');
                    break;
                case 4:
                    setcookie("loginType","manager");
                    header('Location: index.php?page=account&view=manager');
                    break;
                case 5:
                    setcookie("loginType","rental");
                    header('Location: index.php?page=account&view=rental');
                    break;
                case 6:
                    setcookie("loginType","booking");
                    header('Location: index.php?page=account&view=booking');
                    break;
                case 7:
                    setcookie("loginType","guest");
                    header('Location: index.php?page=account&view=guest');
                    break;
                default:
                    header('Location: index.php?page=error&view=noMode');
                    break;
            }

        } else if ($personType === "A") {
            setcookie("loginType","admin");
            header('Location: index.php?page=account&view=admin');

        }
    }







}