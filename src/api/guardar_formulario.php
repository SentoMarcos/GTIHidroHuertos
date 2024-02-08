<?php
// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$codigoPostal = $_POST['codigo-postal'];
$mensaje = $_POST['informacion-adicional'];

// Conectar a la base de datos
$conexion = new mysqli('mborper.upv.edu.es', 'mborper_sprint4', '7puB950%y', 'mborper_sprint4');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Insertar los datos en la tabla de la base de datos
$sql = "INSERT INTO clientes (nombre, email, zip, mensaje,`estado-venta`) VALUES ('$nombre', '$correo', '$codigoPostal', '$mensaje',0)";

if ($conexion->query($sql) === true) {
    // Redireccionar a la página deseada
    header("Location: ../contactoPronto.html");
    exit(); // Asegurarse de que el script se detenga después de la redirección
} else {
    echo "Error al insertar datos: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>

