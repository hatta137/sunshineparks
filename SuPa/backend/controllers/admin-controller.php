<?php
require_once __DIR__.'/../models/person.php';
require_once __DIR__.'/../models/address.php';
require_once __DIR__.'/../models/employee.php';
require_once __DIR__.'/../models/resort.php';
class AdminController extends Controller{


    public function actionShowEmployees(){

        $allEmployees = Employee::getAllEmployees();

        $persondata = [];
        $allAddresses = [];
        $allResorts = [];


        foreach ($allEmployees as $employee){

            $newPerson = new Person($employee->PersonID);

            $persondata[] = $newPerson;
            $allAddresses[] = Address::findByPersonID($newPerson->PersonID);

            $allResorts[] = $employee->getResort();

        }

        $this->_params['allEmployees'] = $allEmployees;
        $this->_params['persondata'] = $persondata;
        $this->_params['allAddresses'] = $allAddresses;
        $this->_params['allResorts'] = $allResorts;



    }

    public function actionEditEmployee(){


        $currentEmp = new Employee($_POST['EmpID']);
        $currentPerson = new Person($currentEmp->PersonID);
        $currentAddress = Address::findByPersonID($currentEmp->PersonID);


        $this->_params['currentEmp'] = $currentEmp;
        $this->_params['currentPerson'] = $currentPerson;
        $this->_params['currentAddress'] = $currentAddress;
        $this->_params['currentResort'] = $currentEmp->getResort();



    }

    public function actionUpdatedEmployee(){


        $resortID = Resort::getResortIDByName($_POST['Resort']);



        $updatedEmp = Employee::updateEmp(

            $_POST['EmpID'],
            $_POST['FirstName'],
            $_POST['LastName'],
            $_POST['DateOfBirth'],
            $_POST['Tel'],
            $_POST['Mail'],
            $_POST['Manager'],
            $_POST['Job'],
            $_POST['Street'],
            $_POST['HNumber'],
            $_POST['ZipCode'],
            $_POST['State'],
            $_POST['City'],
            $resortID

            // TODO PasswordHash einbauen
        );

        $this->_params['updatedEmp'] = $updatedEmp;

    }


}