<?php

class Guest extends Model {

    public function __construct($guestID)
    {
        parent::__construct("GUEST", "GuestID", $guestID);
    }


    /**
     * Author: Max Schelenz
     * Finds a guest object by its personid.
     * @param $personId
     * @return Guest|null The guest object if it is found, or null if it is not found.
     */
    public static function findByPersonId($personId) : ?Guest {

        $db = getDB();

        try{
            $stmt = $db->prepare('SELECT GuestID FROM GUEST WHERE PersonID = ?');
            $stmt->execute([$personId]);
            $row = $stmt->fetch();

            if (!$row) {
                return null;
            }

            }catch(Exception $e) {
                echo $e->getMessage();
        }

            return new Guest($row['GuestID']);
    }

    /**
     * Author: Max Schelenz
     * @param $PersonID
     * @return bool
     */

    public function delete($PersonID) : bool {

        $db = getDB();

        try {

            $db->beginTransaction();

            $stmt = $db->prepare('DELETE FROM GUEST WHERE PersonID = ?');
            $stmt->execute([$PersonID]);

            $db->commit();

            return true;

        }catch (PDOException $e) {
            echo $e->getMessage();
        }

        return false;
    }

}