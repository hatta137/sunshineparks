<?php

class Renovation extends Model {

    public function __construct($strucchangeId)
    {
        parent::__construct('STRUCCHANGE', 'ChangeID', $strucchangeId);
    }

    /**
     * Author: Max Schelenz
     * Finds all actual renovations from STRUCCHANGE.
     * no params
     * @return array
     */

    public static function getAllRenovation() : array{
        $db = getDB();

        $stmtRenovations = $db->prepare('SELECT * FROM STRUCCHANGE
                                                        JOIN RENTAL ON STRUCCHANGE.RentalID = RENTAL.RentalID
                                                        JOIN CRAFTSERV ON STRUCCHANGE.CraftServID = CRAFTSERV.CraftServID
                                                        ORDER BY STRUCCHANGE.StartDate');
        // nimmt prepare und füllt eventuelle ? mit variablen
        $stmtRenovations->execute([]);

        //geht jede zeile vom ausgeführten druch und speichert sie im array
        $result = $stmtRenovations->fetchAll();


        //die im Array gespeicherten Daten zurückgeben
        return $result;
    }


    /**
     * Author: Max Schelenz
     * @param $resortName
     * @return array
     */
    //TODO Implement the function
    public static function getRenovationByResort($resortName) : array{

        $db = getDB();

        $stmtRenovations = $db->prepare('SELECT ChangeID FROM STRUCCHANGE
                                                              JOIN RENTAL ON STRUCCHANGE.RentalID = RENTAL.RentalID
                                                              JOIN RESORT ON RENTAL.ResortID = RESORT.ResortID
                                                              WHERE RESORT.Name = ?');

        $stmtRenovations->execute([$resortName]);

        $allRenovations = $stmtRenovations->fetchAll();
        /*
         * $allRenovations:
         * Array aus Zeilen, die jeweils auch ein Array sind mit Spaltennamen und zugehörigen Werten
         *
         * [
         *      [
         *          "ChangeID" => "12",
         *          "RentalID" => "9",
         *          ...
         *      ],
         *      [
         *          "ChangeID" => "13",
         *          "RentalID" => "12",
         *          ...
         *      ]
         * ]
         */

        // Ergebnis-Array, mit Instanzen von Renovation Models
        $result = [];

        // Instanzen werden hier erstellt und dem Ergebnis hinzugefügt
        foreach ($allRenovations as $row) {
            $result[] = new Renovation($row["ChangeID"]);
        }

        // TODO @Hendrik bitte mal schauen ob das Model alles erfüllt was du brauchst, dann TODO löschen
        // In dem Array müssen alle Informationen zum Strucchange und dem dazugehörigem Craftserv sowie der RentalID
        // und der Adressen des Craftserv und der Adresse des Rentals sein

        return $result;
    }


    /**
     * Author: Max Schelenz
     * Creates a new Renovation using the database procedure p_NewRenovation.
     * This database procedure uses other sub-functions.
     * @param $rentalID
     * @param $startDate
     * @param $plannedEndDate
     * @param $description
     * @param $plannedCosts
     * @param $companyName
     * @param $craftservCategory
     * @param $phone
     * @param $craftservStreet
     * @param $craftservHouseNumber
     * @param $craftservZipCode
     * @param $craftservCity
     * @param $craftservState
     * @return bool
     */
    //TODO Implement the function

    public static function newRenovation(   $rentalID, $startDate,$plannedEndDate,$description,$plannedCosts,$companyName
                                            ,$craftservCategory,$phone,$craftservStreet,$craftservHouseNumber,$craftservZipCode,
                                            $craftservCity,$craftservState) : bool{
        try {
            $db = getDB();

            $stmtNewRenovation = $db->prepare('call p_NewRenovation(?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmtNewRenovation->execute([$rentalID, $startDate,$plannedEndDate,$description,$plannedCosts,$companyName
                ,$craftservCategory,$phone,$craftservStreet,$craftservHouseNumber,$craftservZipCode,
                $craftservCity,$craftservState]);
            return true;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }

}