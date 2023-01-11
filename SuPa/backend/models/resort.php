<?php

class Resort extends Model{

    public function __construct($resortId)
    {
        parent::__construct("RESORT", "ResortID", $resortId);

    }

    public static function getResortNameByID($resortID) :?String{

        $db = getDB();
        $stmt = $db->prepare('SELECT Name FROM RESORT 
                                    WHERE ResortID = ?');
        $stmt->execute([$resortID]);
        $row = $stmt->fetch();

        if (!$row) {
            return 'kein Resort gefunden';
        }
        return $row['Name'];

    }

    public static function getResortIDByName($name) :?int{

        $db = getDB();
        $stmt = $db->prepare('SELECT ResortID FROM RESORT WHERE Name = ?;');
        $stmt->execute([$name]);
        $row = $stmt->fetch();

        if (!$row) {
            return 'kein Resort gefunden';
        }
        return $row['ResortID'];

    }

}