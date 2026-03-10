<?php

class Donasi {

    private $conn;
    private $table = "donasi";

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($nama,$wa,$doa,$nominal){

        $sql = "INSERT INTO $this->table
                (nama,no_wa,doa,nominal)
                VALUES (?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi",$nama,$wa,$doa,$nominal);

        return $stmt->execute();
    }

    public function getConfirmed(){

        $sql = "SELECT * FROM $this->table
                WHERE status='confirmed'
                ORDER BY created_at DESC";

        return $this->conn->query($sql);
    }

    public function confirm($id){

        $sql = "UPDATE $this->table
                SET status='confirmed'
                WHERE id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id);

        return $stmt->execute();
    }

    public function getAll(){

    $sql = "SELECT * FROM $this->table
            ORDER BY created_at DESC";

    return $this->conn->query($sql);
    }

}