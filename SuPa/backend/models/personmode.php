<?php


/**
 * Author Hendrik Lendeckel
 */
class Personmode extends Model{



    public function __construct($PersonId)
    {
        parent::__construct("PERSONMODE", "PersonModeID", $PersonId);

    }

    public function updateModeID($modeID){
        $db = getDB();

        $stmtPersonMode = $db->prepare('UPDATE PERSONMODE SET
                                            ModeID = ?
                                            WHERE PersonID = ?');

        $stmtPersonMode->execute([$modeID, $this->PersonID]);

    }




}
