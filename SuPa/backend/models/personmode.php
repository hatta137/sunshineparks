<?php

class Personmode extends Model{



    public function __construct($PersonId)
    {
        parent::__construct("PERSONMODE", "PersonModeID", $PersonId);

    }


    /**
     * Author: Hendrik Lendeckel
     * @param $modeID
     * @return void
     */
    public function updateModeID($modeID){
        $db = getDB();

        $stmtPersonMode = $db->prepare('UPDATE PERSONMODE SET
                                            ModeID = ?
                                            WHERE PersonID = ?');

        $stmtPersonMode->execute([$modeID, $this->PersonID]);

    }

    /**
     * Author: Max Schelenz
     * @param $PersonID
     * @return bool
     */

    public static function deletePersonMode($PersonID) : bool {

        try {
            $db = getDB();
            $db->beginTransaction();

            $stmt = $db->prepare('DELETE FROM PERSONMODE WHERE PersonID = ?');
            $stmt->execute([$PersonID]);

            $db->commit();

            return true;

        }catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }




}
