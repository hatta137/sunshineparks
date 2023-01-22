<?php
require_once __DIR__.'/../models/person.php';

// TODO Comments
class RegistrationController extends Controller{

    public function actionRegistration(){

    }

    public function logicAddPerson(){
        if($_POST['pwd']===$_POST['pwdrepeat']) {
            if(Permission::checkForRegistration($_POST['mode'])) {
                $person = Person::newPerson($_POST['fname'], $_POST['lname'], $_POST['birthdate'], $_POST['phone'], $_POST['mail'], $_POST['acctype'], password_hash($_POST['pwd'], PASSWORD_DEFAULT), $_POST['street'], $_POST['housenumber'], $_POST['zipcode'], $_POST['city'], $_POST['country'], $_POST['mode']);
                $_SESSION['person'] = $person->PersonID;
                $personMode = $person->getPersonModeID();

                switch ($personMode) {
                    case 1:
                        header('Location: index.php?page=account&view=admin');
                        break;
                    case 2:
                        header('Location: index.php?page=account&view=cleaning');
                        break;
                    case 3:
                        header('Location: index.php?page=account&view=maintenance');
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
            }else header('location: index.php?page=error&view=noAccess');
        }else{
            header('location: index.php?page=error&view=pwdNotMatching');
        }

    }
}