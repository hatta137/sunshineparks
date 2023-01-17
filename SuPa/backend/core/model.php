<?php



// basic model class - used to define get and set method


class Model
{
    protected array $attributes = array();

    function __construct($tableName, $primaryKeyName, $rowId)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM $tableName WHERE $primaryKeyName = ?");
        $stmt->execute([$rowId]);
        $result = $stmt->fetch();
        if ($result)
            $this->attributes = $result;
    }

    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        throw new Exception('No value for key ' . $key . ' found');
    }

    public function __set($key, $value)
    {
        if (isset($this->attributes[$key])) {
            $this->attributes[$key] = $value;
        }

        throw new Exception('Access invalid!');
    }

}

//Prinzipieller Ablauf für Models und Funktionen

/*
Jedes Model zweigt einen Bereich aus der Datenbank, im besten Fall hat man für jede Tabelle ein Model.

Das Model greift auf die Daten zu die der Controller benötigt. Man kann entweder gleich im Model mit der Selektierung der Daten beginnen oder dann im View.
*/