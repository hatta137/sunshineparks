<?php

class Mode extends Model{

    public function __construct($modeId)
    {
        parent::__construct('Mode', 'modeID', $modeId);
    }



    public static function getModeIDFromJob($job) :?int{
        $db = getDB();
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


        if (!array_key_exists($job, $job_to_role))
            return null;

        $role = $job_to_role[$job];

        $stmtGetModeFromJob = $db->prepare('SELECT ModeID FROM MODE
                                                       WHERE Role = ?');
        $stmtGetModeFromJob->execute([$role]);
        $modeIDRow = $stmtGetModeFromJob->fetch();
        $modeID = $modeIDRow['ModeID'];

        return $modeID;

    }





}