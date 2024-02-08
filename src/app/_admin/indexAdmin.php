<?php
// Configuración de la base de datos
$servername = "mborper.upv.edu.es";
$username = "mborper_sprint4";
$password = "7puB950%y";
$dbname = "mborper_sprint4";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el rol seleccionado
$rolSeleccionado = isset($_GET['rol']) ? $_GET['rol'] : '3';

// Consulta para obtener los usuarios según el rol seleccionado
$sql = "SELECT nombre, id, rol FROM usuarios WHERE rol = " . $rolSeleccionado;
$result = $conn->query($sql);

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrador</title>
    <!--Carga CSS bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
    <!--Carga CSS -->
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<header class="encabezado" role="banner">
    <div class="logo"><a href="../../index.html"><img src="../../img/logo.jpeg" alt="logo GTI"></a></div>
    <div class="notisycerrar">
        <!--aqui va el boton de notificaciones-->
        <div class="notificaciones_container">
            <a class="notificaciones" href="#">
                <i class="bi bi-bell-fill" id="notificaciones"></i>
            </a>
        </div>
        <!--aqui va el boton cerrar sesion-->
        <div><button type="button" class="boton-cerrarsesion" id="boton-cerrarsesion">Cerrar sesión</button></div>
    </div>
</header>
<section class="cabeceraTabla">
    <div class="contenedorSuperior">
        <h2>Gestión Usuarios</h2>
        <!--Seleccionar Rol-->
        <select id="rol" class="rol" onchange="cambiarTabla()">
            <option value="3" <?php if ($rolSeleccionado == '3') echo 'selected'; ?>>Usuario</option>
            <option value="1" <?php if ($rolSeleccionado == '1') echo 'selected'; ?>>Administrador</option>
            <option value="2" <?php if ($rolSeleccionado == '2') echo 'selected'; ?>>Comercial</option>
            <option value="4" <?php if ($rolSeleccionado == '4') echo 'selected'; ?>>Técnico</option>
        </select>
    </div>
    <!--Buscador-->
    <div class="contenedorMedio">
        <input type="text" class="buscadorAdmin" placeholder="Buscar" id="buscador" onkeyup="filtrarTabla()">
        <button class="boton-lupa"><i class="bi bi-search"></i></button>
    </div>
</section>
<section id="tabla" class="contenedorTabla">
    <table class="tablaAdmin">
        <thead>
        <tr id="datos">
            <th>Nombre</th>
            <th>rol</th>
            <th>Usuario</th>
            <th>ID</th>
            <th>
                <div class="add-user" id="anyadir"><p>+</p></div>
            </th>
        </tr>
        </thead>

        <!-- Contenido Tabla Usuarios -->
        <tbody id="tablaUsuarios">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["rol"] . "</td>"; // Dejar el campo "apellido" vacío
                echo "<td></td>"; // Dejar el campo "usuario" vacío
                echo "<td>" . $row["id"] . "</td>";
                echo '<td class="toggle">';
                if (!empty($row["usuario"])) {
                    echo '<input type="checkbox" id="switch' . $row["id"] . '" checked/>';
                } else {
                    echo '<input type="checkbox" id="switch' . $row["id"] . '"/>';
                }
                echo '<label for="switch' . $row["id"] . '">Toggle</label>';
                echo '</td>';
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</section>

<!--Carga JS bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-eJyl4J1amFHRYNoUZUkB9rPqOhLv0dYfTC0KhhW9eHntX+K6ai6K8DbqQT6S5bgL"
        crossorigin="anonymous"></script>
<script>
    function cambiarTabla() {
        var seleccionado = document.getElementById("rol").value;
        window.location.href = "indexAdmin.php?rol=" + seleccionado;
    }

    function filtrarTabla() {
        var input = document.getElementById("buscador");
        var filtro = input.value.toUpperCase();
        var tabla = document.getElementById("tablaUsuarios");
        var filas = tabla.getElementsByTagName("tr");

        for (var i = 0; i < filas.length; i++) {
            var tdNombre = filas[i].getElementsByTagName("td")[0];
            var tdApellido = filas[i].getElementsByTagName("td")[1];
            var tdUsuario = filas[i].getElementsByTagName("td")[2];

            if (tdNombre || tdApellido || tdUsuario) {
                var textoNombre = tdNombre.textContent || tdNombre.innerText;
                var textoApellido = tdApellido.textContent || tdApellido.innerText;
                var textoUsuario = tdUsuario.textContent || tdUsuario.innerText;

                if (textoNombre.toUpperCase().indexOf(filtro) > -1 ||
                    textoApellido.toUpperCase().indexOf(filtro) > -1 ||
                    textoUsuario.toUpperCase().indexOf(filtro) > -1) {
                    filas[i].style.display = "table-row";
                } else {
                    filas[i].style.display = "none";
                }
            }
        }
    }
</script>
<footer class="PiePagina">
    <div class="Copyright">Copyright 2023 All rights Reserved</div>
    <div class="Version">1.0.0.0</div>
</footer>
<!-- Pop-up Cerrar Sesión -->
<dialog id="cerrarsesion">
    <div class="cerrarSesionPopUp">
        <h3>¿Desea cerrar sesión?</h3>
        <div class="botonesCierre">
            <button class="cerrarBoton" id="si-cerrar">Si</button>
            <button class="cerrarBoton" id="no-cerrar">No</button>
        </div>
    </div>
</dialog>

<!-- Pop-up Notificaciones -->
<dialog class="popupnotificaciones" id="popupnotificaciones">
    <div class="arribanotis">
        <h4>Notificaciones</h4>
        <button class="cerrarnotis" id="cerrarnotis">x</button>
    </div>
    <div class="notif">
        <h5>Creación Usuario</h5>
        <p class="pnotif">Nombre: Pedro Apellido: Martinez</p>
    </div>
    <div class="notif">
        <h5>Creación Usuario</h5>
        <p class="pnotif">Nombre: Javier Apellido: Monsell</p>
    </div>
    <div class="notif">
        <h5>Creación Usuario</h5>
        <p class="pnotif">Nombre: Josela Apellido: Beltrán</p>
    </div>
    <div class="notif">
        <h5>Creación Usuario</h5>
        <p class="pnotif">Nombre:Teresa Apellido: Bosch</p>
    </div>
</dialog>

<!-- Pop-up Añadir Usuario -->
<dialog id="popupanyadir">
    <div class="popupanyadir">
        <div class="cabeceraAnyadir">
            <h4>Selecciona Rol:</h4>
            <button id="cerrarAnyadir">x</button>
        </div>
        <div class="datosAnyadir">
            <select id="rolAnyadir" name="rol" class="rolAnyadir" onchange="cambiarTabla()">
                <option value="3" selected>Usuario</option>
                <option value="1">Administrador</option>
                <option value="4">Técnico</option>
                <option value="2">Comercial</option>
            </select>
            <div><p>Nombre</p><input type="text" id="nombreInput"></div>
            <div id="contrasenaDiv" style="display: block;"><p>Contraseña</p><input type="password" id="contrasenaInput"></div>
        </div>
        <button class="botonAceptar">ACEPTAR</button>
    </div>
</dialog>


<script>
    // Aquí va tu código JavaScript para controlar los pop-ups

    const botoncerrarsesion = document.getElementById("boton-cerrarsesion");
    const popupcerrar = document.getElementById('cerrarsesion');
    const botonsi = document.getElementById('si-cerrar');
    const botonno = document.getElementById('no-cerrar');

    botoncerrarsesion.addEventListener('click', () => {
        popupcerrar.showModal();
        popupcerrar.style.display = "block";
    });

    botonno.addEventListener('click', () => {
        popupcerrar.close();
        popupcerrar.style.display = "none";
    });

    botonsi.addEventListener('click', () => {
        window.location.replace('../../index.html');
    });

    const popupnotif = document.getElementById('popupnotificaciones');
    const botonnotif = document.getElementById('notificaciones');
    const botoncerrarnotis = document.getElementById('cerrarnotis');

    botonnotif.addEventListener('click', () => {
        popupnotif.showModal();
        popupnotif.style.display = "block";
    });

    botoncerrarnotis.addEventListener('click', () => {
        popupnotif.close();
        popupnotif.style.display = "none";
    });

    const popupanyadir = document.getElementById('popupanyadir');
    const botonanyadir = document.getElementById('anyadir');
    const botoncerrarAnyadir = document.getElementById('cerrarAnyadir');

    botonanyadir.addEventListener('click', () => {
        popupanyadir.showModal();
        popupanyadir.style.display = "block";
    });

    botoncerrarAnyadir.addEventListener('click', () => {
        popupanyadir.close();
        popupanyadir.style.display = "none";
    });

    const botonAceptar = document.querySelector('#popupanyadir .botonAceptar');
    botonAceptar.addEventListener('click', () => {
        const rol = document.getElementById('rolAnyadir').value;
        const nombre = document.getElementById('nombreInput').value;
        const contrasena = document.getElementById('contrasenaInput').value;

        // Verifica que los campos no estén vacíos antes de enviar la solicitud
        if (rol && nombre && contrasena) {
            // Envía los datos al servidor mediante una petición AJAX o fetch
            fetch('agregarUsuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `rol=${rol}&nombre=${nombre}&contrasena=${contrasena}`
            })
                .then(response => response.json())
                .then(data => {
                    // Realiza acciones adicionales después de agregar el usuario, si es necesario
                    console.log(data); // Puedes mostrar un mensaje de éxito o hacer algo más
                    popupanyadir.style.display = "none";
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            console.error('Faltan parámetros en la solicitud');
        }
    });
</script>
<script src="../js/filtrarUsuariosAdmin.js"></script>
</body>
</html>

