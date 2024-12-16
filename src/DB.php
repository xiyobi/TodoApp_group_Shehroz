<?php
namespace App;

class DB{
    public $host ;
    public $user;
    public $pass;
    public $db;
    public $conn;
    public function __construct(){
        $this->host = $_ENV["DB_HOST"];
        $this->user = $_ENV["DB_USER"];
        $this->pass = $_ENV["DB_PASS"];
        $this->db = $_ENV["DB_NAME"];
        $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
    }
}



?>
