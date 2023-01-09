<?php

class AdminController extends Controller{

    public function showEmployees(){

        $allEmployees = Employee::getAllEmployees();
        $persondata = [];
        $allAddresses = [];
        $allResorts = [];
        foreach ($allEmployees as $employee){
            $newPerson = Person::findByEmp($employee);
            $persondata = $newPerson;
            $allAddresses = Address::findByPersonID($newPerson->AddrID);
            $allResorts = Employee::getResortByID($employee->EmpID);
        }

        $this->_params['allEmployees'] = $allEmployees;
        $this->_params['persondata'] = $persondata;
        $this->_params['allAddresses'] = $allAddresses;
        $this->_params['$allResorts'] = $allResorts;



    }


}