<?php

class Admin extends Model {

    public function __construct($adminID)
    {
        parent::__construct("ADMIN", "AdminID", $adminID);
    }


    /**
     * Author: Max Schelenz
     * Finds a admin object by its personid.
     * @param $personId
     * @return Admin|null The admin object if it is found, or null if it is not found.
     */
    public static function findByPersonID($personId) : ?Admin {

        $db = getDB();

        try{
            $stmt = $db->prepare('SELECT AdminID FROM ADMIN WHERE PersonID = ?');
            $stmt->execute([$personId]);
            $row = $stmt->fetch();

            if (!$row) {
                return null;
            }

        }catch(Exception $e) {
            echo $e->getMessage();
        }

        return new Admin($row['AdminID']);

    }


    /**
     * Author: Max Schelenz
     * Deletes an admin object by its PersonID.
     * @param $PersonID
     * @return bool
     */
    public function delete($PersonID) : bool {

        try {
            $db = getDB();
            $db->beginTransaction();

            $stmt = $db->prepare('DELETE FROM ADMIN WHERE PersonID = ?');
            $stmt->execute([$PersonID]);

            $db->commit();

            return true;

        }catch (PDOException $e) {
            echo $e->getMessage();
        }

        return false;

    }
}