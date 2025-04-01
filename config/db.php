<?php
$host = "127.0.0.1";
$dbName = "php_demo";
$username = "root";
$password = "W2i0l0l2i@neliseu";

$conn = new mysqli($host, $username, $password, $dbName);
if($conn->connect_error){
    die("Erro na conexão: ".$conn->connect_error);
}
$conn->set_charset("utf8");