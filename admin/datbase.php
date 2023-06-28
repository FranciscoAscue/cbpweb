<?php
// detalles
$host = 'localhost';
$dbname = "cbp";
$username = "root";
$password = "123a456"; 

try {
    $conn_web = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn_web->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn_web->exec("set names utf8mb4");
    //echo;
} catch(PDOException $e) {
    echo "La conexion fallo: " . $e->getMessage();
}
?>