<?php

class Guest extends Model {

    public function __construct($guestID)
    {
        parent::__construct("GUEST", "GuestID", $guestID);
    }

    public static function findByPersonId($personId) : ?Guest {
        $db = getDB();

        $stmt = $db->prepare('SELECT GuestID FROM GUEST WHERE PersonID = ?');
        $stmt->execute([$personId]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Guest($row['GuestID']);
    }

}