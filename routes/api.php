<?php

require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../controllers/DonasiController.php';
require_once __DIR__.'/../helpers/response.php';

$db = (new Database())->connect();
$donasiController = new DonasiController($db);

/*
ambil path saja tanpa query string
*/
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/*
hapus trailing slash
*/
$uri = rtrim($uri, '/');

/*
method request
*/
$method = $_SERVER['REQUEST_METHOD'];


/*
ROUTING
*/

if($uri === "/api/donasi" && $method === "POST"){
    $donasiController->create();
}

if($uri === "/api/donasi" && $method === "GET"){
    $donasiController->list();
}

if($uri === "/api/donasi/confirm" && $method === "POST"){
    $donasiController->confirm();
}


/*
jika route tidak ditemukan
*/
jsonResponse([
    "message" => "Route tidak ditemukan"
],404);