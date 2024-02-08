<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comercial-Clientes_Asignados</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/comercial.css">
</head>
<body>

<header class="encabezado" role="banner">
    <div class="logo"><a href="../../index.html"><img src="../../img/logo.jpeg" alt="logo GTI"></a></div>
    <div class="notisycerrar">
        <div>
            <button type="button" class="boton-cerrarsesion" id="boton-cerrarsesion">Cerrar sesión</button>
        </div>
    </div>
</header>

<section class="clientes-asignados">
    <div id="cabezera_clientes-asignados">
        <h2>Clientes Asignados</h2>
    </div>

    <div class="contenedortabla">
        <table class="tablabuzon">
            <?php
            // Conectar a la base de datos
            $conexion = new mysqli('mborper.upv.edu.es', 'mborper_sprint4', '7puB950%y', 'mborper_sprint4');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error en la conexión: " . $conexion->connect_error);
            }

            // Definir el número de registros por página
            $registrosPorPagina = 5;

            // Obtener el número total de registros
            $sqlTotalRegistros = "SELECT COUNT(*) as total FROM clientes WHERE `estado-venta` <> 0";
            $resultadoTotalRegistros = $conexion->query($sqlTotalRegistros);
            $filaTotalRegistros = $resultadoTotalRegistros->fetch_assoc();
            $totalRegistros = $filaTotalRegistros['total'];

            // Calcular el número de páginas
            $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

            // Obtener el número de página actual
            $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

            // Calcular el índice del primer registro a mostrar en la página actual
            $indicePrimerRegistro = ($paginaActual - 1) * $registrosPorPagina;

            // Obtener los registros de la página actual
            $sql = "SELECT nombre, zip, `estado-venta` FROM clientes WHERE `estado-venta` <> 0 LIMIT $indicePrimerRegistro, $registrosPorPagina";
            $resultado = $conexion->query($sql);

            // Comprobar si hay resultados
            if ($resultado->num_rows > 0) {
                // Iterar sobre los resultados y mostrar los datos en la tabla
                while ($fila = $resultado->fetch_assoc()) {
                    $nombre = $fila['nombre'];
                    $zip = $fila['zip'];
                    $estadoVenta = $fila['estado-venta'];

                    echo '<tr class="mensajebuzon">';
                    echo '<td>';
                    echo '<a href="comercialInformacionForm.php" class="mensajebuzon">';
                    echo '<div class="comercial-info-cliente">';
                    echo '<h3 class="comercial-nombre">' . $nombre . '</h3>';
                    echo '<label>ZIP: ' . $zip . '</label>';
                    echo '<label>Técnico asignado: No hay tecnico asignado</label>';
                    echo '</div>';

                    echo '<p>';
                    echo '<div class="espacio-elipse">';
                    if ($estadoVenta == 1) {
                        echo '<div class="circulo_activo"></div>';
                        echo '<div class="circulo"></div>';
                        echo '<div class="circulo"></div>';
                    } elseif ($estadoVenta == 2) {
                        echo '<div class="circulo"></div>';
                        echo '<div class="circulo_activo"></div>';
                        echo '<div class="circulo"></div>';
                    } elseif ($estadoVenta == 3) {
                        echo '<div class="circulo"></div>';
                        echo '<div class="circulo"></div>';
                        echo '<div class="circulo_activo"></div>';
                    }
                    echo '</div>';
                    echo '</p>';

                    echo '</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr class="mensajebuzon">';
                echo '<td>';
                echo '<p>No hay mensajes nuevos</p>';
                echo '</td>';
                echo '</tr>';
            }

            // Cerrar la conexión
            $conexion->close();
            ?>
        </table>
    </div>
</section>

<section class="contenedor-ultima-fila" id="contenedor_ultima_fila">
    <h2><?php echo $totalRegistros; ?> mensajes</h2>
    <div class="paginador-comercial">
        <?php
        // Mostrar enlaces de paginación
        for ($i = 1; $i <= $totalPaginas; $i++) {
            echo '<a href="?pagina=' . $i . '">' . $i . '</a>';
        }
        ?>
    </div>
    <div class="relleno">perdon prof</div>
</section>

<section class="comercial-botones-navegacion">
    <div id="boton-buzon-global">
        <a href="comercialBuzonGlobal.php">
            <input type="button" value="Buzón Global">
        </a>
    </div>

    <div id="boton-clientes asignados">
        <a href="#">
            <input type="button" value="Clientes Asignados">
        </a>
    </div>
</section>

<section class="footer1" id="footersin">
    <p>&#169; 2023 All Rights Reserved</p>
</section>

</body>
</html>


