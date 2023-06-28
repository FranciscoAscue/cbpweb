<?php
// detalles
$host = 'localhost';
$dbname = "cbp";//'cbperuo1_web';
$username = "root";//'cbperuo1_request';
$password = "123a456"; //'3UR6uK!f13h+' ;

try {
    $conn_web = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn_web->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn_web->exec("set names utf8mb4");
    //echo;
} catch(PDOException $e) {
    echo "La conexion fallo: " . $e->getMessage();
}
?>