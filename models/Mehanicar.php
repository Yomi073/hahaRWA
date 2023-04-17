<?php

class MEHANICAR
{
    // Public class attributes corresponding to table columns
    public $ID;
    public $IME;
    public $PREZIME;
    public $BROJ_TELEFONA;
    public $ADRESA;
    public $POLJE_DJELOVANJA;

    // Constructor that assigns the attributes
    public function __construct($ID, $IME, $PREZIME, $BROJ_TELEFONA, $ADRESA, $POLJE_DJELOVANJA)
    {
        $this->ID = $ID;
        $this->IME = $IME;
        $this->PREZIME = $PREZIME;
        $this->BROJ_TELEFONA = $BROJ_TELEFONA;
        $this->ADRESA = $ADRESA;
        $this->POLJE_DJELOVANJA = $POLJE_DJELOVANJA;
    }

    // Static method that returns all records from the table as MEHANICAR objects
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM MEHANICAR');

        foreach ($req->fetchAll() as $record) {
            $list[] = new MEHANICAR($record['ID'], $record['IME'], $record['PREZIME'], $record['BROJ_TELEFONA'], $record['ADRESA'], $record['POLJE_DJELOVANJA']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns a MEHANICAR object
    public static function find($ID)
    {
        $db = Db::getInstance();
        $ID = intval($ID);
        $req = $db->prepare('SELECT * FROM MEHANICAR WHERE ID = :ID');
        $req->execute(array('ID' => $ID));
        $record = $req->fetch();

        return new MEHANICAR($record['ID'], $record['IME'], $record['PREZIME'], $record['BROJ_TELEFONA'], $record['ADRESA'], $record['POLJE_DJELOVANJA']);
    }

    public function create()
    {
        $db = Db::getInstance();
        $sql = "INSERT INTO MEHANICAR (IME, PREZIME, BROJ_TELEFONA, ADRESA, POLJE_DJELOVANJA)
            VALUES (:IME, :PREZIME, :BROJ_TELEFONA, :ADRESA, :POLJE_DJELOVANJA)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':IME', $this->IME);
        $stmt->bindParam(':PREZIME', $this->PREZIME);
        $stmt->bindParam(':BROJ_TELEFONA', $this->BROJ_TELEFONA);
        $stmt->bindParam(':ADRESA', $this->ADRESA);
        $stmt->bindParam(':POLJE_DJELOVANJA', $this->POLJE_DJELOVANJA);
        return $stmt->execute();
    }

    public function update()
    {
        $db = Db::getInstance();
        $sql = "UPDATE MEHANICAR SET IME = :IME, PREZIME = :PREZIME, BROJ_TELEFONA = :BROJ_TELEFONA, 
            ADRESA = :ADRESA, POLJE_DJELOVANJA = :POLJE_DJELOVANJA WHERE ID = :ID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ID', $this->ID);
        $stmt->bindParam(':IME', $this->IME);
        $stmt->bindParam(':PREZIME', $this->PREZIME);
        $stmt->bindParam(':BROJ_TELEFONA', $this->BROJ_TELEFONA);
        $stmt->bindParam(':ADRESA', $this->ADRESA);
        $stmt->bindParam(':POLJE_DJELOVANJA', $this->POLJE_DJELOVANJA);
        return $stmt->execute();
    }

    public static function delete($ID)
    {
        $db = Db::getInstance();
        $ID = intval($ID);
        $sql = "DELETE FROM MEHANICAR WHERE ID = :ID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ID', $ID);
        return $stmt->execute();
    }
}

?>