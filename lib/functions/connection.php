<?php

class Connection
{
    private $server;
    private $user;
    private $password;
    private $db;

    public function __construct($server, $user, $password, $db)
    {
        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
    }

    public function conn()
    {
        $conn = new mysqli($this->server, $this->user, $this->password, $this->db);
        if ($conn->connect_error)
            echo ("Connection Issue!");
        else
            return $conn;
    }
}

?>