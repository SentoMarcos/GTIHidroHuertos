<?php

// Verificar la conexión a la base de datos
require_once 'includes/connexion.php';
if (!isset($connexion)) die();

require_once 'includes/PeticionREST.inc';

// Realizar la consulta para obtener los nombres de los huertos
$query = "SELECT `nombre` FROM `huertos` LIMIT 5";
$resultado = mysqli_query($connexion, $query);

// Verificar si la consulta fue exitosa
if ($resultado) {
    $nombresHuertos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $nombreHuerto = $fila['nombre'];
        $nombresHuertos[] = $nombreHuerto;
    }

    // Devolver los nombres de los huertos como un JSON
    header('Content-Type: application/json');
    echo json_encode($nombresHuertos);
} else {
    echo "Error en la consulta: " . mysqli_error($connexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($connexion);


