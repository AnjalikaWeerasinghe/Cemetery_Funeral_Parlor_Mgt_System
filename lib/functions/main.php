<?php

include_once('connection.php');

class MainController
{

    protected $conn;

    public function __construct()
    {
        $this->connObj = new Connection("127.0.0.1", "root", "newStrongPassword123!", "cemetery_db");
        $this->conn = $this->connObj->conn();
        return $this->conn;

        // $db = new Connection("127.0.0.1", "root", "", "cemetery_db");
        // $this->conn = $db->conn();
        // return $this->conn;
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>
