<?php
require_once __DIR__.'/../models/person.php';



class AccountController extends Controller {

    /**
     * Author: Dario Dassler
     * this method overrides the core method from the parent class Controller
     * @return bool
     */
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

    /**
     * Author: Dario Dassler
     * This method deletes a person's entry in the database
     * @return void
     */
    public function actionDeletedPerson(){
        $person = new Person($_SESSION['person']);
        $person->getChildClass()->delete($_SESSION['person']);
        Personmode::deletePersonMode($_SESSION['person']);
        Person::deletePerson($_SESSION['person']);
        $this->actionLogout();
    }

    /**
     * Author: Dario Dassler
     * This method deletes the session entry and logs the person out
     * @return void
     */
    public function actionLogout(){
        unset($_SESSION['person']);
    }


}
