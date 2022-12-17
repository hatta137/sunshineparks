<?php



// basic model class - used to define get and set method


class Model
{
    protected array $attributes = array();

    protected static function getDB(): PDO{


        static $db = null;

        if ($db == null) {
            $dsn = 'mysql:host=localhost;dbname=SunshineParksWeb;charset=utf8';
            $db = new PDO($dsn, "root", "");

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return $db;

    }



    function __construct($tableName, $rowId)
    {
        $db = self::getDB();
        $stmt = $db->prepare("SELECT * FROM $tableName WHERE id = ?");
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
