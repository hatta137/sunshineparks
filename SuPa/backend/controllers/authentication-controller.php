<?php
require_once __DIR__.'/../models/person.php';
class AuthenticationController extends Controller {



    public function actionAuthenticationGuest(){

    }

    public function actionAuthenticationIntern(){

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
        } else if ($personType === "E") {
            switch ($personMode){
                case 1:
                    header('Location: index.php?page=account&view=admin');
                    break;
                case 2:
                    header('Location: index.php?page=account&view=cleaning');
                    break;
                case 3:
                    header('Location: index.php?page=account&view=maintanance');
                    break;
                case 4:
                    header('Location: index.php?page=account&view=manager');
                    break;
                case 5:
                    header('Location: index.php?page=account&view=rental');
                    break;
                case 6:
                    header('Location: index.php?page=account&view=booking');
                    break;
                case 7:
                    header('Location: index.php?page=account&view=guest');
                    break;
                default:
                    header('Location: index.php?page=error&view=noMode');
                    break;
            }

        } else if ($personType === "A") {
            header('Location: index.php?page=account&view=admin');

        }
    }







}