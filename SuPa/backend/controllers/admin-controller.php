<?php
require_once __DIR__.'/../models/person.php';
require_once __DIR__.'/../models/address.php';
require_once __DIR__.'/../models/employee.php';
require_once __DIR__.'/../models/resort.php';
class AdminController extends Controller{

    public function rightsCheck(): bool
    {
        return Permission::checkForAction($this->_actionLogicName);
    }

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

        $currentEmp = new Employee($_POST['EmpID']);
        $currentPerson = new Person($currentEmp->PersonID);
        $currentAddress = Address::findByPersonID($currentEmp->PersonID);

        // list of fiels in html form
        $fieldsPerson   = array("FirstName", "LastName", "DateOfBirth", "Tel", "Mail", "PasswordHash");
        $fieldsEmp      = array("Manager", "Job");
        $fieldsAddr     = array("Street", "HNumber", "ZipCode", "State", "City");
        foreach ($fieldsPerson as $field){
            if (isset($_POST[$field]) && !empty($_POST[$field])){
                ${$field} = $_POST[$field];
            }else{
                ${$field} = $currentPerson->{$field};
            }
        }

        foreach ($fieldsEmp as $field){
            if (isset($_POST[$field]) && !empty($_POST[$field])){
                ${$field} = $_POST[$field];
            }else{
                ${$field} = $currentEmp->{$field};
            }
        }

        foreach ($fieldsAddr as $field){
            if (isset($_POST[$field]) && !empty($_POST[$field])){
                ${$field} = $_POST[$field];
            }else{
                ${$field} = $currentAddress->{$field};
            }
        }



        $updatedEmp = Employee::updateEmp(

            $_POST['EmpID'],
            $FirstName,
            $LastName,
            $DateOfBirth,
            $Tel,
            $Mail,
            $Manager,
            $Job,
            $Street,
            $HNumber,
            $ZipCode,
            $State,
            $City,
            $PasswordHash,
            $resortID

            // TODO PasswordHash einbauen
        );

        $this->_params['updatedEmp'] = $updatedEmp;

    }


}