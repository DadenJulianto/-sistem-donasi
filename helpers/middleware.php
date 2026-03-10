<?php

require_once __DIR__.'/response.php';

function authMiddleware(){

    $headers = getallheaders();

    if(!isset($headers['Authorization'])){
        jsonResponse([
            "message" => "token tidak ditemukan"
        ],401);
    }

    $authHeader = $headers['Authorization'];

    $token = str_replace("Bearer ","",$authHeader);

    $tokenPath = __DIR__."/../storage/tokens/".$token;

    if(!file_exists($tokenPath)){
        jsonResponse([
            "message" => "token tidak valid"
        ],401);
    }

}