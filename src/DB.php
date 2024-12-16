<?php
namespace App;
 class DB {
    public $host ;
    public $user ;
    public $pass ;
    public $dt_name;


    public $conn;
    public function __construct(){
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASS'];
        $this->dt_name = $_ENV['DB_NAME'];
        $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->dt_name, $this->user, $this->pass);
    }
}
