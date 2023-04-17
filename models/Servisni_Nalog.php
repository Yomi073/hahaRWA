<?php

class SERVISNI_NALOG
{
    // Public class attributes corresponding to table columns
    public $ID;
    public $DATUM_PRIMITKA;
    public $DATUM_ZAVRSETKA;
    public $KOMENTAR;
    public $UKUPNA_CIJENA;
    public $AUTOMOBIL_FK;

    // Constructor that assigns the attributes
    public function __construct($ID, $DATUM_PRIMITKA, $DATUM_ZAVRSETKA, $KOMENTAR, $UKUPNA_CIJENA, $AUTOMOBIL_FK)
    {
        $this->ID = $ID;
        $this->DATUM_PRIMITKA = $DATUM_PRIMITKA;
        $this->DATUM_ZAVRSETKA = $DATUM_ZAVRSETKA;
        $this->KOMENTAR = $KOMENTAR;
        $this->UKUPNA_CIJENA = $UKUPNA_CIJENA;
        $this->AUTOMOBIL_FK = $AUTOMOBIL_FK;
    }

    // Static method that returns all records from the table as SERVISNI_NALOG objects
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM servisni_nalog');

        foreach ($req->fetchAll() as $record) {
            $list[] = new SERVISNI_NALOG($record['id'], $record['datum_primitka'], $record['datum_zavrsetka'], $record['komentar'], $record['ukupna_cijena'], $record['automobil_fk']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns a SERVISNI_NALOG object
    public static function find($ID)
    {
        $db = Db::getInstance();
        $ID = intval($ID);
        $req = $db->prepare('SELECT * FROM servisni_nalog WHERE id = :id');
        $req->execute(array('id' => $ID));
        $record = $req->fetch();

        return new SERVISNI_NALOG($record['id'], $record['datum_primitka'], $record['datum_zavrsetka'], $record['komentar'], $record['ukupna_cijena'], $record['automobil_fk']);
    }
}

?>