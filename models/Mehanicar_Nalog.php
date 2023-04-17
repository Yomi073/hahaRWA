<?php

class MEHANICAR_NALOG
{
    // Public class attributes corresponding to table columns
    public $ID;
    public $RADNI_SATI;
    public $CIJENA_SATA;
    public $MEHANICAR_FK;
    public $SERVISNI_NALOG_FK;

    // Constructor that assigns the attributes
    public function __construct($ID, $RADNI_SATI, $CIJENA_SATA, $MEHANICAR_FK, $SERVISNI_NALOG_FK)
    {
        $this->ID = $ID;
        $this->RADNI_SATI = $RADNI_SATI;
        $this->CIJENA_SATA = $CIJENA_SATA;
        $this->MEHANICAR_FK = $MEHANICAR_FK;
        $this->SERVISNI_NALOG_FK = $SERVISNI_NALOG_FK;
    }

    // Static method that returns all records from the table as MEHANICAR_NALOG objects
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM MEHANICAR_NALOG');

        foreach ($req->fetchAll() as $record) {
            $list[] = new MEHANICAR_NALOG($record['ID'], $record['RADNI_SATI'], $record['CIJENA_SATA'], $record['MEHANICAR_FK'], $record['SERVISNI_NALOG_FK']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns a MEHANICAR_NALOG object
    public static function find($ID)
    {
        $db = Db::getInstance();
        $ID = intval($ID);
        $req = $db->prepare('SELECT * FROM MEHANICAR_NALOG WHERE ID = :ID');
        $req->execute(array('ID' => $ID));
        $record = $req->fetch();

        return new MEHANICAR_NALOG($record['ID'], $record['RADNI_SATI'], $record['CIJENA_SATA'], $record['MEHANICAR_FK'], $record['SERVISNI_NALOG_FK']);
    }
}

?>