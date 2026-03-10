<?php

require_once __DIR__.'/../models/Donasi.php';
require_once __DIR__.'/../helpers/response.php';

class DonasiController {

    private $donasi;

    public function __construct($db){
        $this->donasi = new Donasi($db);
    }

    public function create(){

        $data = json_decode(file_get_contents("php://input"),true);

        $nama = $data['nama'];
        $wa = $data['no_wa'];
        $doa = $data['doa'];
        $nominal = $data['nominal'];

        if($this->donasi->create($nama,$wa,$doa,$nominal)){
            jsonResponse(["message"=>"donasi berhasil"]);
        }

        jsonResponse(["message"=>"gagal"],500);
    }

    public function list(){

        $result = $this->donasi->getConfirmed();

        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        jsonResponse($data);
    }

    public function confirm(){

        $data = json_decode(file_get_contents("php://input"),true);

        if($this->donasi->confirm($data['id'])){
            jsonResponse(["message"=>"donasi confirmed"]);
        }

        jsonResponse(["message"=>"error"],500);
    }

}