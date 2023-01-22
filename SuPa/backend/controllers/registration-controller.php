<?php
require_once __DIR__.'/../models/person.php';
require_once __DIR__.'/../controllers/authentication-controller.php';

class RegistrationController extends Controller{


    /**
     * Author Dario Dassler
     * This method creates a new person in the database if the rights and data are correct.
     * After that, the new person will be logged in.
     * @return void
     */

    public function logicAddPerson(){
        if($_POST['pwd']===$_POST['pwdrepeat']) {
            if(Permission::checkForRegistration($_POST['mode'])) {
                $person = Person::newPerson($_POST['fname'], $_POST['lname'], $_POST['birthdate'], $_POST['phone'], $_POST['mail'], $_POST['acctype'], password_hash($_POST['pwd'], PASSWORD_DEFAULT), $_POST['street'], $_POST['housenumber'], $_POST['zipcode'], $_POST['city'], $_POST['country'], $_POST['mode']);
                AuthenticationController::logIn($person->PersonID, $person->getPersonModeID());
            }else header('location: index.php?page=error&view=noAccess');
        }else{
            header('location: index.php?page=error&view=pwdNotMatching');
        }

    }
}