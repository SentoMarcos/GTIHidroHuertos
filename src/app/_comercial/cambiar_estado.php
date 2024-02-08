
<?php
// Conectar a la base de datos
$conexion = new mysqli('mborper.upv.edu.es', 'mborper_sprint4', '7puB950%y', 'mborper_sprint4');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtener los datos enviados por la solicitud AJAX/Fetch API
$data = json_decode(file_get_contents('php://input'), true);
$idCliente = $data['id'];
$estadoVenta = $data['estadoVenta'];

// Actualizar el estado-venta en la base de datos
$sql = "UPDATE clientes SET `estado-venta` = $estadoVenta WHERE id = $idCliente";
if ($conexion->query($sql) === TRUE) {
    // Éxito al actualizar el estado-venta

    // Crear una respuesta de éxito para enviar al cliente
    $response = [
        'success' => true
    ];
    echo json_encode($response);
} else {
    // Error al actualizar el estado-venta

    // Crear una respuesta de error para enviar al cliente
    $response = [
        'success' => false,
        'error' => 'Error al actualizar el estado-venta: ' . $conexion->error
    ];
    echo json_encode($response);
}

// Cerrar la conexión
$conexion->close();
?>
