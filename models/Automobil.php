<?php
class Automobil {
    // Public class attributes corresponding to table columns
    public $ID;
    public $BROJ_SASIJE;
    public $GODINA_PROIZVODNJE;
    public $KILOMETRAZA;
    public $BOJA;
    public $KORISNIK_FK;
    public $MODEL_FK;

    // Constructor that assigns the attributes
    public function __construct($ID, $BROJ_SASIJE, $GODINA_PROIZVODNJE, $KILOMETRAZA, $BOJA, $KORISNIK_FK, $MODEL_FK) {
        $this->ID = $ID;
        $this->BROJ_SASIJE = $BROJ_SASIJE;
        $this->GODINA_PROIZVODNJE = $GODINA_PROIZVODNJE;
        $this->KILOMETRAZA = $KILOMETRAZA;
        $this->BOJA = $BOJA;
        $this->KORISNIK_FK = $KORISNIK_FK;
        $this->MODEL_FK = $MODEL_FK;
    }

    // Static method that returns all records from the table as AUTOMOBIL objects
    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM AUTOMOBIL');

        foreach($req->fetchAll() as $record) {
            $list[] = new AUTOMOBIL($record['ID'], $record['BROJ_SASIJE'], $record['GODINA_PROIZVODNJE'], $record['KILOMETRAZA'], $record['BOJA'], $record['KORISNIK_FK'], $record['MODEL_FK']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns an AUTOMOBIL object
    public static function find($id) {
        $db = Db::getInstance();
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM AUTOMOBIL WHERE ID = :id');
        $req->execute(array('id' => $id));
        $record = $req->fetch();

        return new AUTOMOBIL($record['ID'], $record['BROJ_SASIJE'], $record['GODINA_PROIZVODNJE'], $record['KILOMETRAZA'], $record['BOJA'], $record['KORISNIK_FK'], $record['MODEL_FK']);
    }

    public function create() {
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO AUTOMOBIL (BROJ_SASIJE, GODINA_PROIZVODNJE, KILOMETRAZA, BOJA, KORISNIK_FK, MODEL_FK) VALUES (:broj_sasije, :godina_proizvodnje, :kilometraza, :boja, :korisnik_fk, :model_fk)');
        $req->bindParam(':broj_sasije', $this->BROJ_SASIJE);
        $req->bindParam(':godina_proizvodnje', $this->GODINA_PROIZVODNJE);
        $req->bindParam(':kilometraza', $this->KILOMETRAZA);
        $req->bindParam(':boja', $this->BOJA);
        $req->bindParam(':korisnik_fk', $this->KORISNIK_FK);
        $req->bindParam(':model_fk', $this->MODEL_FK);
        $req->execute();
        $this->ID = $db->lastInsertId();
        return $this;
    }

    public function update() {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE AUTOMOBIL SET BROJ_SASIJE = :broj_sasije, GODINA_PROIZVODNJE = :godina_proizvodnje, KILOMETRAZA = :kilometraza, BOJA = :boja, KORISNIK_FK = :korisnik_fk, MODEL_FK = :model_fk WHERE ID = :id');
        $req->bindParam(':broj_sasije', $this->BROJ_SASIJE);
        $req->bindParam(':godina_proizvodnje', $this->GODINA_PROIZVODNJE);
        $req->bindParam(':kilometraza', $this->KILOMETRAZA);
        $req->bindParam(':boja', $this->BOJA);
        $req->bindParam(':korisnik_fk', $this->KORISNIK_FK);
        $req->bindParam(':model_fk', $this->MODEL_FK);
        $req->bindParam(':id', $this->ID);
        $req->execute();
        return $this;
    }

    public function delete() {
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM AUTOMOBIL WHERE ID = :id');
        $req->execute(array('id' => $this->ID));
        return true;
    }
}
?>