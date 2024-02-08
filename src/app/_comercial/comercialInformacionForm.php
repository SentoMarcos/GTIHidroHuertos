<?php
// Realizar la conexión a la base de datos
$conexion = new mysqli('mborper.upv.edu.es', 'mborper_sprint4', '7puB950%y', 'mborper_sprint4');

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
    exit();
}

// Obtener el ID del cliente seleccionado
$clienteID = isset($_GET['clienteID']) ? intval($_GET['clienteID']) : 0;

// Consultar la base de datos para obtener los datos del cliente
$query = "SELECT nombre, zip, email, mensaje FROM clientes WHERE id = $clienteID";
$resultado = mysqli_query($conexion, $query);

// Verificar si se encontraron resultados
if (mysqli_num_rows($resultado) > 0) {
    // Obtener los datos del cliente
    $row = mysqli_fetch_assoc($resultado);
    $nombre = $row['nombre'];
    $codigoPostal = $row['zip'];
    $correo = $row['email'];
    $ultimoMensaje = $row['mensaje'];
} else {
    echo "No se encontraron datos del cliente";
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<!-- Resto del código HTML omitido por brevedad -->

<div class="contenedor_tecnico_nombre">
    <!-- Resto del código HTML omitido por brevedad -->

    <div class="contenedor_formularios_datos">
        <div class="primer_hijo_datos_formulario">
            <form>
                <h4 class="dato-formulario">Nombre</h4>
                <input type="text" value="<?php echo isset($nombre) ? $nombre : ''; ?>" readonly class="info-formulario">
            </form>
        </div>

        <div class="segundo_hijo_datos_formulario">
            <form>
                <h4 class="dato-formulario">Código Postal</h4>
                <input type="text" value="<?php echo isset($codigoPostal) ? $codigoPostal : ''; ?>" readonly class="info-formulario">
            </form>
        </div>
    </div>

    <div class="formulario_todo_width">
        <form>
            <h4 class="dato-formulario">Correo electrónico</h4>
            <input type="email" value="<?php echo isset($correo) ? $correo : ''; ?>" readonly class="info-formulario" id="formulario-correo">
        </form>
    </div>

    <div class="formulario_todo_width">
        <form>
            <h4 class="dato-formulario">Último mensaje</h4>
            <textarea id="textarea" class="info-formulario" readonly><?php echo isset($ultimoMensaje) ? $ultimoMensaje : ''; ?></textarea>
        </form>
    </div>
</div>

<!----------------------------------------->
<!---Inicio seccion botones formulario----->
<!----------------------------------------->

<section class="comercial-botones-formulario">
    <div class="botones-container">
        <input type="button" value="        Responder       " class="botones">
        <input type="button" value="    Asignar técnico   " class="botones">
        <input type="button" value="Mensaje anteriores" class="botones">
    </div>
</section>

<!----------------------------------------->
<!------Fin seccion botones formulario----->
<!----------------------------------------->

<section class="footer1" id="footersin">
    <p>&#169; 2023 All Rights Reserved</p>
</section>

</body>
</html>