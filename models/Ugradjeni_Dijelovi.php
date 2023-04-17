<?php

class UGRADJENI_DIJELOVI
{
    // Public class attributes corresponding to table columns
    public $ID;
    public $BROJ_UGRADJENIH_DIJELOVA;
    public $SERVISNI_NALOG_FK;
    public $DIO_FK;

    // Constructor that assigns the attributes
    public function __construct($ID, $BROJ_UGRADJENIH_DIJELOVA, $SERVISNI_NALOG_FK, $DIO_FK)
    {
        $this->ID = $ID;
        $this->BROJ_UGRADJENIH_DIJELOVA = $BROJ_UGRADJENIH_DIJELOVA;
        $this->SERVISNI_NALOG_FK = $SERVISNI_NALOG_FK;
        $this->DIO_FK = $DIO_FK;
    }

    // Static method that returns all records from the table as UGRADJENI_DIJELOVI objects
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM UGRADJENI_DIJELOVI');

        foreach ($req->fetchAll() as $record) {
            $list[] = new UGRADJENI_DIJELOVI($record['ID'], $record['BROJ_UGRADJENIH_DIJELOVA'], $record['SERVISNI_NALOG_FK'], $record['DIO_FK']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns a UGRADJENI_DIJELOVI object
    public static function find($ID)
    {
        $db = Db::getInstance();
        $ID = intval($ID);
        $req = $db->prepare('SELECT * FROM UGRADJENI_DIJELOVI WHERE ID = :ID');
        $req->execute(array('ID' => $ID));
        $record = $req->fetch();

        return new UGRADJENI_DIJELOVI($record['ID'], $record['BROJ_UGRADJENIH_DIJELOVA'], $record['SERVISNI_NALOG_FK'], $record['DIO_FK']);
    }
}

?>