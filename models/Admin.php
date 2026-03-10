<?php

class Admin {

    private $conn;
    private $table = "admin";

    public function __construct($db){
        $this->conn = $db;
    }

    public function login($username){

        $sql = "SELECT * FROM $this->table WHERE username=? LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",$username);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

}