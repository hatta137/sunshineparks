<?php

class Resort extends Model{

    public function __construct($resortId)
    {
        parent::__construct("RESORT", "ResortID", $resortId);

    }

    /**
     * Author Hendrik Lendeckel
     * This function determines the appropriate resort name for the resort ID.
     * @param $resortID
     * @return String|null
     */
    public static function getResortNameByID($resortID) :?String{

        $db = getDB();

        try {
            $stmt = $db->prepare('SELECT Name FROM RESORT 
                                    WHERE ResortID = ?');
            $stmt->execute([$resortID]);
            $row = $stmt->fetch();

            if (!$row) {
                return 'kein Resort gefunden';
            }
            return $row['Name'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;

    }

    /**
     * Author Hendrik Lendeckel
     * This function determines the resort ID for matching resort names.
     * @param $name
     * @return int|null
     */
    public static function getResortIDByName($name) :?int{

        $db = getDB();

        try {
            $stmt = $db->prepare('SELECT ResortID FROM RESORT WHERE Name = ?;');
            $stmt->execute([$name]);
            $row = $stmt->fetch();


            return $row['ResortID'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;

    }

}