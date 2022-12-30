<?php

class Address extends Model {

    public function __construct($addressID)
    {
        parent::__construct("ADDR", "AddrID", $addressID);
    }

}