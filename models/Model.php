<?php

class Model
{
    // Public class attributes corresponding to table columns
    public $ID;
    public $NAZIV_MODELA;
    public $GORIVO;
    public $TRANSMISIJA;
    public $MARKA_VOZILA_FK;

    // Constructor that assigns the attributes
    public function __construct($ID, $NAZIV_MODELA, $GORIVO, $TRANSMISIJA, $MARKA_VOZILA_FK)
    {
        $this->ID = $ID;
        $this->NAZIV_MODELA = $NAZIV_MODELA;
        $this->GORIVO = $GORIVO;
        $this->TRANSMISIJA = $TRANSMISIJA;
        $this->MARKA_VOZILA_FK = $MARKA_VOZILA_FK;
    }

    // Static method that returns all records from the table as Model objects
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM MODEL');

        foreach ($req->fetchAll() as $record) {
            $list[] = new Model($record['ID'], $record['NAZIV_MODELA'], $record['GORIVO'], $record['TRANSMISIJA'], $record['MARKA_VOZILA_FK']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns a Model object
    public static function find($ID)
    {
        $db = Db::getInstance();
        $ID = intval($ID);
        $req = $db->prepare('SELECT * FROM MODEL WHERE ID = :ID');
        $req->execute(array('ID' => $ID));
        $record = $req->fetch();

        return new Model($record['ID'], $record['NAZIV_MODELA'], $record['GORIVO'], $record['TRANSMISIJA'], $record['MARKA_VOZILA_FK']);
    }
}

?>