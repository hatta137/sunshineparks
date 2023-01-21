<?php
require_once __DIR__.'/../models/person.php';


// TODO Comments
class AccountController extends Controller {

    public function rightsCheck(): bool
    {
        return Permission::checkForSite($this->_actionLogicName);
    }

    public function actionGuest(){

    }

    public function actionManager(){

    }

    public function actionAdmin(){



    }

    public function actionCleaning(){

    }

    public function actionMaintenance(){

    }

    public function actionRental(){

    }

    public function actionBooking(){

    }

    public function actionDeletedPerson(){
        $person = new Person($_SESSION['person']);
        $person->getChildClass()->delete($_SESSION['person']);
        Personmode::deletePersonMode($_SESSION['person']);
        Person::deletePerson($_SESSION['person']);
        $this->actionLogout();
    }

    public function actionLogout(){
        unset($_SESSION['person']);
    }


}
