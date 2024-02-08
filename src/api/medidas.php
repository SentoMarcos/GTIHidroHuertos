<?php
// Verificar la conexión a la base de datos
require_once 'includes/connexion.php';
if (!isset($connexion)) die();
require_once 'includes/PeticionREST.inc';

// Obtener el parámetro id_tipo_sensor de la URL
$idTipoSensor = $_GET['id_tipo_sensor'];

// Verificar si se proporcionaron las fechas de inicio y fin
if (isset($_GET['fecha-desde']) && isset($_GET['fecha-hasta'])) {
    // Obtener los parámetros de fecha de la URL
    $fechaInicio = $_GET['fecha-desde'];
    $fechaFin = $_GET['fecha-hasta'];

    // Modificar la consulta SQL para filtrar por fechas
    $sql = "SELECT * FROM medidas
            INNER JOIN sensores ON medidas.`id-sensor` = sensores.`id-sensor`
            WHERE sensores.`tipo-sensor` = $idTipoSensor
            AND medidas.fecha >= '$fechaInicio' AND medidas.fecha <= '$fechaFin'
            ORDER BY medidas.fecha ASC";
} else {
    // Utilizar la consulta sin filtros por fechas
    $sql = "SELECT * FROM medidas
            INNER JOIN sensores ON medidas.`id-sensor` = sensores.`id-sensor`
            WHERE sensores.`tipo-sensor` = $idTipoSensor
            ORDER BY medidas.fecha ASC limit 7";
}

// Ejecutar la consulta SQL
$result = mysqli_query($connexion, $sql);

// Verificar si se obtuvieron resultados
if ($result) {
    // Recorrer los resultados y agregarlos al arreglo de salida
    $salida = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $salida[] = $row;
    }

    // Obtener el valor de la medida más reciente
    $valorMedidaReciente = null;
    if (!empty($salida)) {
        $$valorMedidaReciente = null;
        if (!empty($salida)) {
            end($salida); // Coloca el puntero interno del arreglo en la última posición
            $ultimaFila = $salida[key($salida)]; // Obtiene el valor de la última fila
            $valorMedidaReciente = $ultimaFila['valor-medida'];
        }
    }
} else {
    // Manejo del error si la consulta no se ejecutó correctamente
    die("Error en la ejecución de la consulta: " . mysqli_error($connexion));
}

// Construir el arreglo de respuesta
$respuesta = [
    'medidas' => $salida,
    'valorMedidaReciente' => $valorMedidaReciente,
    'tipoDeSensor' => $idTipoSensor
];

// Establecer encabezado y enviar la respuesta como JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($respuesta);

