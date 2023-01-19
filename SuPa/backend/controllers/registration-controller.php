<?php
require_once __DIR__.'/../models/person.php';

// TODO Comments
class RegistrationController extends Controller{

    public function actionRegistration(){

    }

    public function logicRegistration(){
        if($_POST['pwd']===$_POST['pwdrepeat']) {
            $person = Person::newPerson($_POST['fname'], $_POST['lname'], $_POST['birthdate'], $_POST['phone'], $_POST['mail'], "G", password_hash($_POST['pwd'], PASSWORD_DEFAULT), $_POST['street'], $_POST['housenumber'], $_POST['zipcode'], $_POST['city'], $_POST['country'], "7");
            $_SESSION['person'] = $person->PersonID;
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
        }else{
            echo "Bruder gib mal zwei gleiche Passwörter ein"; //@Todo error page machen
        }

    }
}