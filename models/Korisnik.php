<?php

class KORISNIK
{
    // Public class attributes corresponding to table columns
    public $ID;
    public $IME;
    public $PREZIME;
    public $BROJ_TELEFONA;
    public $ADRESA;

    // Constructor that assigns the attributes
    public function __construct($ID, $IME, $PREZIME, $BROJ_TELEFONA, $ADRESA)
    {
        $this->ID = $ID;
        $this->IME = $IME;
        $this->PREZIME = $PREZIME;
        $this->BROJ_TELEFONA = $BROJ_TELEFONA;
        $this->ADRESA = $ADRESA;
    }

    // Static method that returns all records from the table as KORISNIK objects
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM korisnik');

        foreach ($req->fetchAll() as $record) {
            $list[] = new KORISNIK($record['id'], $record['ime'], $record['prezime'], $record['broj_telefona'], $record['adresa']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns a KORISNIK object
    public static function find($id)
    {
        $db = Db::getInstance();
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM korisnik WHERE id = :id');
        $req->execute(array('id' => $id));
        $record = $req->fetch();

        return new KORISNIK($record['id'], $record['ime'], $record['prezime'], $record['broj_telefona'], $record['adresa']);
    }

    // Create a new record in the table
    public static function create($IME, $PREZIME, $BROJ_TELEFONA, $ADRESA)
    {
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO korisnik (ime, prezime, broj_telefona, adresa) VALUES (:ime, :prezime, :broj_telefona, :adresa)');
        $req->execute(array('ime' => $IME, 'prezime' => $PREZIME, 'broj_telefona' => $BROJ_TELEFONA, 'adresa' => $ADRESA));
        return $db->lastInsertId();
    }

    // Update an existing record in the table
    public static function update($ID, $IME, $PREZIME, $BROJ_TELEFONA, $ADRESA)
    {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE korisnik SET ime = :ime, prezime = :prezime, broj_telefona = :broj_telefona, adresa = :adresa WHERE id = :id');
        $req->execute(array('id' => $ID, 'ime' => $IME, 'prezime' => $PREZIME, 'broj_telefona' => $BROJ_TELEFONA, 'adresa' => $ADRESA));
        return $req->rowCount();
    }

    // Delete a record from the table
    public static function delete($ID)
    {
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM korisnik WHERE id = :id');
        $req->execute(array('id' => $ID));
        return $req->rowCount();
    }
}

?>