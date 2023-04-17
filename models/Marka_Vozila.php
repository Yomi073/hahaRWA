<?php

class MARKA_VOZILA
{
    // Public class attributes corresponding to table columns
    public $ID;
    public $NAZIV_MARKE;
    public $ZEMLJA_PORIJEKLA;

    // Constructor that assigns the attributes
    public function __construct($ID, $NAZIV_MARKE, $ZEMLJA_PORIJEKLA)
    {
        $this->ID = $ID;
        $this->NAZIV_MARKE = $NAZIV_MARKE;
        $this->ZEMLJA_PORIJEKLA = $ZEMLJA_PORIJEKLA;
    }

    // Static method that returns all records from the table as MARKA_VOZILA objects
    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM MARKA_VOZILA');

        foreach ($req->fetchAll() as $record) {
            $list[] = new MARKA_VOZILA($record['ID'], $record['NAZIV_MARKE'], $record['ZEMLJA_PORIJEKLA']);
        }

        return $list;
    }

    // Static method that finds a record by ID and returns a MARKA_VOZILA object
    public static function find($ID)
    {
        $db = Db::getInstance();
        $ID = intval($ID);
        $req = $db->prepare('SELECT * FROM MARKA_VOZILA WHERE ID = :ID');
        $req->execute(array('ID' => $ID));
        $record = $req->fetch();

        return new MARKA_VOZILA($record['ID'], $record['NAZIV_MARKE'], $record['ZEMLJA_PORIJEKLA']);
    }

    // Method to create a new record in the table
    public static function create($NAZIV_MARKE, $ZEMLJA_PORIJEKLA)
    {
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO MARKA_VOZILA (NAZIV_MARKE, ZEMLJA_PORIJEKLA) VALUES (:NAZIV_MARKE, :ZEMLJA_PORIJEKLA)');
        $req->execute(array('NAZIV_MARKE' => $NAZIV_MARKE, 'ZEMLJA_PORIJEKLA' => $ZEMLJA_PORIJEKLA));

        // Return the ID of the new record
        return $db->lastInsertId();
    }

    // Method to update an existing record in the table
    public static function update($ID, $NAZIV_MARKE, $ZEMLJA_PORIJEKLA)
    {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE MARKA_VOZILA SET NAZIV_MARKE = :NAZIV_MARKE, ZEMLJA_PORIJEKLA = :ZEMLJA_PORIJEKLA WHERE ID = :ID');
        $req->execute(array('ID' => $ID, 'NAZIV_MARKE' => $NAZIV_MARKE, 'ZEMLJA_PORIJEKLA' => $ZEMLJA_PORIJEKLA));

        // Return the number of rows affected by the update
        return $req->rowCount();
    }

    // Method to delete a record from the table
    public static function delete($ID)
    {
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM MARKA_VOZILA WHERE ID = :ID');
        $req->execute(array('ID' => $ID));

        // Return the number of rows affected by the delete
        return $req->rowCount();
    }
}

?>