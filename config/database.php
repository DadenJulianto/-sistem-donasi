<?php

class Database{

    private $host = "mysql";
    private $user = "root";
    private $pass = "";
    private $db = "donasi_db";

    public $conn;


    public function connect(){

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if($this->conn->connect_error){
            die("Database gagal terhubung");
        }

        return $this->conn;
    }
}