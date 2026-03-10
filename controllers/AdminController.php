<?php

require_once __DIR__.'/../models/Admin.php';
require_once __DIR__.'/../helpers/response.php';
require_once __DIR__.'/../helpers/auth.php';

class AdminController {

    private $admin;

    public function __construct($db){
        $this->admin = new Admin($db);
    }

    public function login(){

        $data = json_decode(file_get_contents("php://input"),true);

        $user = $this->admin->login($data['username']);

        if(!$user){
            jsonResponse(["message"=>"user tidak ditemukan"],401);
        }

        if(!password_verify($data['password'],$user['password'])){
            jsonResponse(["message"=>"password salah"],401);
        }

        $token = generateToken();

        file_put_contents(
            __DIR__.'/../storage/tokens/'.$token,
            $user['id']
        );

        jsonResponse([
            "message"=>"login berhasil",
            "token"=>$token
        ]);
    }

}