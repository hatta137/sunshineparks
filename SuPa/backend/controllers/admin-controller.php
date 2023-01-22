<?php
require_once __DIR__.'/../models/person.php';
require_once __DIR__.'/../models/address.php';
require_once __DIR__.'/../models/employee.php';
require_once __DIR__.'/../models/resort.php';
require_once __DIR__.'/../models/mode.php';
require_once __DIR__.'/../models/personmode.php';
class AdminController extends Controller{


    /**
     * Author Hendrik Lendeckel
     * This function passes to the showEmployees view an array filled with all the data about the person,
     * an array with information about the address, and an array with information about the resort, from all employees.
     * @return void
     */
    public function actionShowEmployees() :void{

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

    /**
     * Author Hendrik Lendeckel
     * This function gets the Employee ID of an employee via $_POST[ ] and
     * passes all information about this employee to the edit Employee view.
     * The information comes from the showEmployee view.
     * @return void
     */
    public function actionEditEmployee():void{


        $currentEmp = new Employee($_POST['EmpID']);
        $currentPerson = new Person($currentEmp->PersonID);
        $currentAddress = Address::findByPersonID($currentEmp->PersonID);


        $this->_params['currentEmp'] = $currentEmp;
        $this->_params['currentPerson'] = $currentPerson;
        $this->_params['currentAddress'] = $currentAddress;
        $this->_params['currentResort'] = $currentEmp->getResort();



    }

    /**
     * Author Hendrik Lendeckel
     * This function receives the information that is to be changed for the employee via $_POST[ ].
     * These come from the view editEmployee. It passes all information about this employee after this
     * update to the view updatedEmployee. If no changes have been made, the current value is retained.
     * @throws Exception
     */
    public function actionUpdatedEmployee() :void{


        $resortID = Resort::getResortIDByName($_POST['Resort']);

        $currentEmp = new Employee($_POST['EmpID']);
        $currentPerson = new Person($currentEmp->PersonID);
        $currentAddress = Address::findByPersonID($currentEmp->PersonID);

        // list of fields in html form
        $fieldsPerson   = array("FirstName", "LastName", "DateOfBirth", "Tel", "Mail", "PasswordHash");
        $fieldsEmp      = array("Manager", "Job");
        $fieldsAddr     = array("Street", "HNumber", "ZipCode", "State", "City");



        /* The following foreach loops iterate through the respective fields
        (separated according to the table in which this information is found).
        If a POST value is set, this is taken, if not, the current value of the employee is entered.*/

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