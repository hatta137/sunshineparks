<?php

class CraftService extends Model {

    public function __construct($craftservID)
    {
        parent::__construct("CRAFTSERV", "CraftServID", $craftservID);
    }

}