<?php

class Admin extends Model {

    public function __construct($adminID)
    {
        parent::__construct("ADMIN", "AdminID", $adminID);
    }

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