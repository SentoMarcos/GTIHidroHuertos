<?php
$servername = "mborper.upv.edu.es";
$username = "mborper_sprint4";
$password = "7puB950%y";
$dbname = "mborper_sprint4";

try {
    $connexion = new mysqli($servername, $username, $password, $dbname);
    if ($connexion->connect_errno) {
        http_response_code(500);
        die("Error de conexión a la base de datos: " . $connexion->connect_error);
    }
} catch (Exception $e) {
    http_response_code(500);
    die("Error: " . $e->getMessage());
}

$connexion->query('SET NAMES utf8mb4');
