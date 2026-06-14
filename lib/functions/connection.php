<?php

/**
 * Class Name: Connection
 * Description: Establishes and manages the connection between the Cemetery and Funeral Parlor Management System and the MySQL database.
 *
 * Responsibilities:
 *   - Store database connection parameters.
 *   - Create a MySQL database connection.
 *   - Return the connection object for use by other classes.
 */
class Connection
{
    private $server;
    private $user;
    private $password;
    private $db;

    // Constructor to initialize database connection parameters
    public function __construct($server, $user, $password, $db)
    {
        $this->server = $server; // Database server address
        $this->user = $user; // Database username
        $this->password = $password; // Database password
        $this->db = $db; // Database name
    }

    // Method to establish and return the database connection
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