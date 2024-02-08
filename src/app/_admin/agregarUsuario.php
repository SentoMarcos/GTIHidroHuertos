<?php
// Obtener los valores enviados desde el formulario
$rolValue = $_POST['rol'];
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

// Mapeo del valor del campo rol al número correspondiente en la base de datos
if ($rolValue === '3') {
    $rol = 3; // Usuario
} else if ($rolValue === '1') {
    $rol = 1; // Administrador
} else if ($rolValue === '4') {
    $rol = 4; // Técnico
} else if ($rolValue === '2') {
    $rol = 2; // Comercial
} else {
    $response = ['success' => false, 'message' => 'Error al agregar el usuario: Valor de rol inválido'];
    echo json_encode($response);
    exit();
}

// Realizar la conexión a la base de datos (reemplaza los valores con los de tu configuración)
$servername = "mborper.upv.edu.es";
$username = "mborper_sprint4";
$password = "7puB950%y";
$dbname = "mborper_sprint4";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insertar el nuevo usuario en la base de datos
    $stmt = $conn->prepare('INSERT INTO usuarios (rol, nombre, contrasenya) VALUES (?, ?, ?)');
    $stmt->execute([$rol, $nombre, $contrasena]);

    $response = ['success' => true, 'message' => 'Usuario agregado correctamente'];
    echo json_encode($response);
} catch(PDOException $e) {
    $response = ['success' => false, 'message' => 'Error al agregar el usuario: ' . $e->getMessage()];
    echo json_encode($response);
}

$conn = null;
?>

