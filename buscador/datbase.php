<?php
// detalles
$host = 'localhost';
$dbname = "cbperu";
$username = "root";
$password = "123a456";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8mb4");
    //echo;
} catch(PDOException $e) {
    echo "La conexion fallo: " . $e->getMessage();
}
?>