<?php

class Guest extends Model {

    public function __construct($guestID)
    {
        parent::__construct("GUEST", "GuestID", $guestID);
    }


    // TODO Try Catch
    /**
     * Author: Max Schelenz
     * Finds an guest object by its personid.
     * @param $personId
     * @return Guest|null The guest object if it is found, or null if it is not found.
     */
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