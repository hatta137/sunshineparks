<?php

class Rental extends Model{

    public function __construct($rowId)
    {
        parent::__construct('RENTAL', $rowId);
    }

    public static function getAllRental(){

        $db = self::getDB();
        $stmt = $db->prepare('SELECT RentalID FROM RENTAL');
        $stmt->execute();
        $result = array();
        foreach ($stmt->fetchAll() as $row){
            $result[] = new Rental($row['RentalID']);
        }
        return $result;
    }


}
