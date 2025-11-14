<?php

$host = "localhost";
$dbname = "php_crud";
$username = "root";
$password = "";

try{
    $pdo = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexion exitosa";

}catch(PDOException $e){
    echo "Error al conectarse a la db ".$e->getMessage();
}

?>