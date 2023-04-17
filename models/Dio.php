<?php

class DIO
{
    // Public class attributes corresponding to table columns
    public $ID;
    public $NAZIV_DIJELA;
    public $NABAVNA_CIJENA;
    public $PRODAJNA_CIJENA;

    // Constructor that assigns the attributes
    public function __construct($ID, $NAZIV_DIJELA, $NABAVNA_CIJENA, $PRODAJNA_CIJENA)
    {
        $this->ID = $ID;
        $this->NAZIV_DIJELA = $NAZIV_DIJELA;
        $this->NABAVNA_CIJENA = $NABAVNA_CIJENA;
        $this->PRODAJNA_CIJENA = $PRODAJNA_CIJENA;
    }

    // Static method that returns all records from the table as DIO objects
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM DIO');

        foreach ($req->fetchAll() as $record) {
            $list[] = new DIO($record['ID'], $record['NAZIV_DIJELA'], $record['NABAVNA_CIJENA'], $record['PRODAJNA_CIJENA']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns a DIO object
    public static function find($ID)
    {
        $db = Db::getInstance();
        $ID = intval($ID);
        $req = $db->prepare('SELECT * FROM DIO WHERE ID = :ID');
        $req->execute(array('ID' => $ID));
        $record = $req->fetch();

        return new DIO($record['ID'], $record['NAZIV_DIJELA'], $record['NABAVNA_CIJENA'], $record['PRODAJNA_CIJENA']);
    }

    public static function create($NAZIV_DIJELA, $NABAVNA_CIJENA, $PRODAJNA_CIJENA)
    {
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO DIO (NAZIV_DIJELA, NABAVNA_CIJENA, PRODAJNA_CIJENA) VALUES (:NAZIV_DIJELA, :NABAVNA_CIJENA, :PRODAJNA_CIJENA)');
        $req->execute(array('NAZIV_DIJELA' => $NAZIV_DIJELA, 'NABAVNA_CIJENA' => $NABAVNA_CIJENA, 'PRODAJNA_CIJENA' => $PRODAJNA_CIJENA));
        $id = $db->lastInsertId();
        return new DIO($id, $NAZIV_DIJELA, $NABAVNA_CIJENA, $PRODAJNA_CIJENA);
    }

    public function update()
    {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE DIO SET NAZIV_DIJELA = :NAZIV_DIJELA, NABAVNA_CIJENA = :NABAVNA_CIJENA, PRODAJNA_CIJENA = :PRODAJNA_CIJENA WHERE ID = :ID');
        $req->execute(array('NAZIV_DIJELA' => $this->NAZIV_DIJELA, 'NABAVNA_CIJENA' => $this->NABAVNA_CIJENA, 'PRODAJNA_CIJENA' => $this->PRODAJNA_CIJENA, 'ID' => $this->ID));
    }

    public function delete()
    {
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM DIO WHERE ID = :ID');
        $req->execute(array('ID' => $this->ID));
    }
}

?>