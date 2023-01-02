<?php

class Person extends Model
{

    public function __construct($personId)
    {
        parent::__construct('PERSON', 'PersonID', $personId);
    }

    // TODO: Add AccountType to database

    public function getChildClass() : mixed {
        if ($this->AccountType == "guest") {
            return Guest::findByPersonId($this->PersonID);
        } else if ($this->AccountType == "employee") {
            return Employee::findByPersonId($this->PersonID);
        } else if ($this->AccountType == "admin") {
            return Admin::findByPersonId($this->PersonID);
        } else {//noAccountType settet
            return null;
        }
    }

}