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
        $this->_params['person'] = $person;
        $this->_params['special'] = $person->getChildClass();
        $this->_params['personMode'] = Person::getPersonModeByID($person->PersonID);
        //personmode in _params
        if ($personType === "G") {
            header('Location: index.php?page=account&view=guest');
        } else if ($personType === "E") {
            header('Location: index.php?page=account&view=manager');

        } else if ($personType === "A") {
            header('Location: index.php?page=account&view=admin');

        }
    }

        public function logicAccountSite(){
            //'A', 'C', 'M', 'MGT', 'R', 'B', 'G'
            switch ($personMode){
                case 'A':
                    header('Location: index.php?page=account&view=admin');
                    break;
                case 'C':
                    header('Location: index.php?page=account&view=cleaning');
                    break;
                case 'M':
                    header('Location: index.php?page=account&view=maintanance');
                    break;
                case 'MGT':
                    header('Location: index.php?page=account&view=manager');
                    break;
                case 'R':
                    header('Location: index.php?page=account&view=rental');
                    break;
                case 'B':
                    header('Location: index.php?page=account&view=booking');
                    break;
                case 'G':
                    header('Location: index.php?page=account&view=guest');
                    break;
                default:
                    header('Location: index.php?page=error&view=noMode');
                    break;
            }
        }




}