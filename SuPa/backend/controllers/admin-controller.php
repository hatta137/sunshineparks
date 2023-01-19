<?php
require_once __DIR__.'/../models/person.php';
require_once __DIR__.'/../models/address.php';
require_once __DIR__.'/../models/employee.php';
require_once __DIR__.'/../models/resort.php';
require_once __DIR__.'/../models/mode.php';
require_once __DIR__.'/../models/personmode.php';
class AdminController extends Controller{


    public function actionShowEmployees(){

        // get all Employees as Array
        $allEmployees = Employee::getAllEmployees();


        // create Arrays for Dates
        $persondata = [];
        $allAddresses = [];
        $allResorts = [];

        // fill the Array with Dates for each employee
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

    /**
     * @throws Exception
     */
    public function actionUpdatedEmployee(){


        $resortID = Resort::getResortIDByName($_POST['Resort']);

        $currentEmp = new Employee($_POST['EmpID']);
        $currentPerson = new Person($currentEmp->PersonID);
        $currentAddress = Address::findByPersonID($currentEmp->PersonID);

        // list of fields in html form
        $fieldsPerson   = array("FirstName", "LastName", "DateOfBirth", "Tel", "Mail", "PasswordHash");
        $fieldsEmp      = array("Manager", "Job");
        $fieldsAddr     = array("Street", "HNumber", "ZipCode", "State", "City");





        foreach ($fieldsPerson as $field){
            if (isset($_POST[$field]) && !empty($_POST[$field])){

                if ($field === "PasswordHash")
                    ${$field} = password_hash($_POST[$field], PASSWORD_DEFAULT);
                else {
                    ${$field} = $_POST[$field];
                }


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



        // Update Personmode
        $modeID = Mode::getModeIDFromJob($Job);
        // ModeID = null when Job not in RoleMatrix

        if ($modeID == null){
            $Job = $currentEmp->Job;
            $modeID = Mode::getModeIDFromJob($Job);
        }


        $personMode = new Personmode($currentEmp->PersonID);
        $personMode->updateModeID($modeID);

        // Update Employee Data
        $updatedEmp = $currentEmp->updateEmp($_POST['EmpID'], $Manager, $Job, $resortID);

        // Update Person Data
        $updatedPerson = $currentPerson->updatePerson($FirstName, $LastName, $DateOfBirth, $Tel, $Mail, $PasswordHash);

        // Update Address Data
        $updatedAddress = $currentAddress->updateAddress($Street, $HNumber, $ZipCode, $City, $State);


        $this->_params['updatedEmp'] = $updatedEmp;
        $this->_params['updatedPerson'] = $updatedPerson;
        $this->_params['updatedAddress'] = $updatedAddress;

    }


}