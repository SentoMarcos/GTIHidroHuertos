<?php
// Verificar la conexión a la base de datos
require_once 'includes/connexion.php';
if (!isset($connexion)) die();
require_once 'includes/PeticionREST.inc';

$peticion = new PeticionREST('api');

$recurso = $peticion->recurso();

$metodo = strtolower($peticion->metodo());

$salida = [];

// archivo a importar según el recurso solicitado
$file = "recursos/$recurso.$metodo.inc";

// Detectar la ruta y llamar a la función correspondiente
if ($recurso === 'medidas' && $metodo === 'get') {
    //incluye el archivo de get medidas
    require_once 'recursos/medidas.get.inc';
} else {
    // se ve luego
}

// comprobar que existe, si no, devolver error 400
if(!file_exists($file)) {
    http_response_code(400);
    die();
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($salida);
