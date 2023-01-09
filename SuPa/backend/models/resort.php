<?php

class Resort extends Model{

    public function __construct($resortId)
    {
        parent::__construct("RESORT", "ResortID", $resortId);

    }

    public static function getResortNameByID($resortID) :?String{

        $db = self::getDB();
        $stmt = $db->prepare('SELECT Name FROM RESORT 
                                    WHERE ResortID = ?');
        $stmt->execute([$resortID]);
        $row = $stmt->fetch();

        if (!$row) {
            return 'kein Resort gefunden';
        }
        return $row['Name'];

    }

}