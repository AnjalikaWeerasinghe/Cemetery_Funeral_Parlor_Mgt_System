<?php
include_once('connection.php');

/**
 * Class Name: MainController
 * Description: Base controller class responsible for establishing and managing the database connection.
 *              Other controllers inherit from this class to reuse the same connection.
 *              
 * Dependencies:
 *   - Connection Class
 *   - MySQL Database
 */
class MainController
{

    protected $conn;

    /**
     * Function Name: __construct
     * Description: Creates a database connection when an object of the controller is instantiated.
     *
     * Parameters:
     *   - None
     *
     * Returns:
     *   - Database connection object
     */
    public function __construct()
    {
        $this->connObj = new Connection("127.0.0.1", "root", "newStrongPassword123!", "cemetery_db");
        $this->conn = $this->connObj->conn();
        return $this->conn;
    }

    /**
     * Function Name: getConnection
     * Description: Returns the active database connection object for use in child controllers.
     *
     * Parameters:
     *   - None
     *
     * Returns:
     *   - mysqli connection object
     */
    public function getConnection() {
        return $this->conn;
    }
}

?>
