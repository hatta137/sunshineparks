<?php

class Rentalpictures extends Model{

    public function __construct($RentalPicturesID)
    {
        parent::__construct("RENTALPICTURES", "RentalPicturesID", $RentalPicturesID);
    }

    /**
     * Author Hendrik Lendeckel
     * This function creates a new entry in the Rentalpictures Table
     * @param $path
     * @param $RentalID
     * @return Rentalpictures|null
     */

    public static function newRentalPicture($path, $RentalID) :?Rentalpictures{
        $db = getDB();

        try {

            $stmt = $db->prepare('INSERT INTO RENTALPICTURES (RentalID, Path) VALUES (?, ?)');
            $stmt->execute([$RentalID, $path]);

            return new Rentalpictures($db->lastInsertId());

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;
    }



}