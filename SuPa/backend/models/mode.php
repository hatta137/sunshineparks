<?php

class Mode extends Model{

    public function __construct($modeId)
    {
        parent::__construct('Mode', 'modeID', $modeId);
    }


    /**
     * Author Hendrik Lendeckel
     * This static function uses the employee's job string to determine the corresponding ModeID.
     * In the intermediate step, the role is determined from the job string.
     * @param $job
     * @return int|null
     */
    public static function getModeIDFromJob($job) :?int{

        $db = getDB();

        try {
            $job_to_role = array(
                'CEO' => "Mgr",
                'Resort-Manager' => "Mgr",
                'Instandhaltungsverwalter' => "Mgr",
                'Buchungsverwalter' => "B",
                'Objektverwalter' => "R",
                'Instandhaltungskraft' => "M",
                'Reinigungsverwalter' => "R",
                'Reinigungskraft' => "C",
                'admin' => "A"
            );

            // If Job not an array-Key return null
            if (!array_key_exists($job, $job_to_role))
                return null;

            $role = $job_to_role[$job];

            $stmtGetModeFromJob = $db->prepare('SELECT ModeID FROM MODE
                                                       WHERE Role = ?');
            $stmtGetModeFromJob->execute([$role]);
            $modeIDRow = $stmtGetModeFromJob->fetch();
            $modeID = $modeIDRow['ModeID'];

            return $modeID;
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;

    }





}