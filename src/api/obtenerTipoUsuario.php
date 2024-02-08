<?php
// Conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "mborper.upv.edu.es";
$username = "mborper_sprint4";
$password = "7puB950%y";
$dbname = "mborper_sprint4";

// Obtener los datos enviados en el cuerpo de la solicitud
$nombre = $_POST['nombre'];
$contrasenya = $_POST['contrasenya'];

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Escapar los valores de los campos de nombre y contraseña para evitar inyección de SQL
$nombre = $conn->real_escape_string($nombre);
$contrasenya = $conn->real_escape_string($contrasenya);

// Consulta SQL para obtener el tipo de usuario
$sql = "SELECT rol FROM usuarios WHERE nombre = '$nombre' AND contrasenya = '$contrasenya'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tipoUsuario = $row['rol'];

    // Crear un array con el tipo de usuario y enviarlo como respuesta JSON
    $response = array('tipoUsuario' => $tipoUsuario);
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array('tipoUsuario' => null);
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
