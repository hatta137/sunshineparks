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

    /**
     * @throws Exception
     */
    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        throw new Exception('No value for key ' . $key . ' found');
    }

    /**
     * @throws Exception
     */
    public function __set($key, $value)
    {
        if (isset($this->attributes[$key])) {
            $this->attributes[$key] = $value;
        }

        throw new Exception('Access invalid!');
    }

    /**
     * @return array All attributes in array force
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}

