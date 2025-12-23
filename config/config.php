<?php
class Config{

    private $host = "localhost";
    private $user = 'root';
    private $pass = '';
    private $dbname = 'taskmanagement';

    protected $conn;

    //make construtor

    public function __construct()
    {
        $this->conn = new mysqli(
        $this->host,
        $this->user,
        $this->pass,
        $this->dbname
    );
    
    if($this->conn->connect_error)
    {
        die("Database Connection failed");
    }
    }
}
?>