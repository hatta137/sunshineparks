<?php


/**
 * Author Hendrik Lendeckel
 */
class Personmode extends Model{



    public function __construct($PersonId)
    {
        parent::__construct("PERSONMODE", "PersonModeID", $PersonId);

    }

    /**
     * Author Hendrik Lendeckel
     * This function updates the value modeID in the PERSONMODE table:
     * @param $modeID
     * @return void
     */
    public function updateModeID($modeID){

        $db = getDB();

        try {
            $stmtPersonMode = $db->prepare('UPDATE PERSONMODE SET
                                            ModeID = ?
                                            WHERE PersonID = ?');

            $stmtPersonMode->execute([$modeID, $this->PersonID]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
