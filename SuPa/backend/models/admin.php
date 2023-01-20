<?php

class Admin extends Model {

    public function __construct($adminID)
    {
        parent::__construct("ADMIN", "AdminID", $adminID);
    }

    // TODO Try Catch
    /**
     * Author: Max Schelenz
     * Finds a admin object by its personid.
     * @param $personId
     * @return Admin|null The admin object if it is found, or null if it is not found.
     */
    public static function findByPersonID($personId) : ?Admin {
        $db = getDB();
        $stmt = $db->prepare('SELECT AdminID FROM ADMIN WHERE PersonID = ?');
        $stmt->execute([$personId]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Admin($row['AdminID']);
    }
}