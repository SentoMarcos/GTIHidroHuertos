<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comercial-Buzon_Global</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/comercial.css">
</head>
<body>

<header class="encabezado" role="banner">
    <div class="logo"><a href="../../index.html"><img src="../../img/logo.jpeg" alt="logo GTI"></a></div>
    <div class="notisycerrar">
        <div><button type="button" class="boton-cerrarsesion" id="boton-cerrarsesion">Cerrar sesión</button></div>
    </div>
</header>

<section class="buzon-formularios">
    <div id="cabezera_buzon">
        <h2>Buzón Global</h2>
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

            // Obtener el número total de registros con estado-venta igual a 0
            $sqlTotalRegistros = "SELECT COUNT(*) as total FROM clientes WHERE `estado-venta` = 0";
            $resultadoTotalRegistros = $conexion->query($sqlTotalRegistros);
            $filaTotalRegistros = $resultadoTotalRegistros->fetch_assoc();
            $totalRegistros = $filaTotalRegistros['total'];

            // Calcular el número de páginas
            $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

            // Obtener el número de página actual
            $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

            // Calcular el índice del primer registro a mostrar en la página actual
            $indicePrimerRegistro = ($paginaActual - 1) * $registrosPorPagina;

            // Obtener los registros de la página actual con estado-venta igual a 0
            $sql = "SELECT id, nombre, `estado-venta` FROM clientes WHERE `estado-venta` = 0 LIMIT $indicePrimerRegistro, $registrosPorPagina";
            $resultado = $conexion->query($sql);

            // Comprobar si hay resultados
            if ($resultado->num_rows > 0) {
                // Iterar sobre los resultados y mostrar los datos en la tabla
                while ($fila = $resultado->fetch_assoc()) {
                    $idCliente = $fila['id'];
                    $nombre = $fila['nombre'];
                    $estadoVenta = $fila['estado-venta'];

                    echo '<tr class="mensajebuzon">';
                    echo '<td>';
                    echo '<h3 class="comercial-nombre">' . $nombre . '</h3>';
                    echo '<form onsubmit="asignarCliente(event, ' . $idCliente . ')">';
                    echo '<input type="submit" value="Asignar" class="botones">';
                    echo '</form>';
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

    <dialog id="popup-buzon-global" class="popup-buzon-global">
        <h2>El cliente ha sido asignado</h2>
        <button onclick="redirectToPage()" class="botones">Acceder a Clientes Asignados</button>
    </dialog>
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
        <a href="#">
            <input type="button" value="Buzón Global" class="botones-generales">
        </a>
    </div>

    <div id="boton-clientes-asignados">
        <a href="comercialClientesAsignados.php">
            <input type="button" value="Clientes Asignados" class="botones" id="boton-popup">
        </a>
    </div>
</section>

<section class="footer1" id="footersin">
    <p>&#169; 2023 All Rights Reserved</p>
</section>

<script>
    function asignarCliente(event, idCliente) {
        event.preventDefault();

        // Realizar una petición al servidor para cambiar el estado de venta
        // Puedes utilizar AJAX o Fetch API para realizar la petición
        // Ejemplo con Fetch API:
        fetch('cambiar_estado.php', {
            method: 'POST',
            body: JSON.stringify({ id: idCliente, estadoVenta: 1 }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                if (response.ok) {
                    eliminarFila(idCliente);
                    mostrarPopupAsignado();
                } else {
                    console.error('Error al asignar el cliente');
                }
            })
            .catch(error => {
                console.error('Error al asignar el cliente:', error);
            });
    }

    function eliminarFila(idCliente) {
        const fila = document.getElementById('fila-' + idCliente);
        if (fila) {
            fila.remove();
        }
    }

    const popup = document.getElementById('popup-buzon-global');
    const botonpopup = document.querySelector('.botones')

    botonpopup.addEventListener('click', () => {
        popup.style.display = 'block';
        popup.showModal();
    })

    function redirectToPage() {
        window.location.href = "comercialClientesAsignados.php";
    }
</script>

</body>
</html>

