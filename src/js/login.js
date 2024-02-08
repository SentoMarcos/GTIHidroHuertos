let nombreUsuario = '';

async function login(event) {
    const output = document.getElementById("output");
    output.classList.remove("error");

    event.preventDefault();
    const formData = new FormData(event.target);

    const respuesta = await fetch('../api/obtenerTipoUsuario.php', {
        method: 'post',
        body: formData
    });

    if (respuesta.ok) {
        const data = await respuesta.json();
        const nombre = formData.get('nombre');
        nombreUsuario = nombre;
        console.log(nombreUsuario);
        const contrasenya = formData.get('password'); // Corregido el nombre del campo

        const tipoUsuario = data.tipoUsuario;
        if (tipoUsuario) {
            switch (tipoUsuario) {
                case '4':
                    location.href = 'app/_tecnico/tecnicoMenu.html';
                    break;
                case '1':
                    location.href = 'app/_admin/indexAdmin.php';
                    break;
                case '2':
                    location.href = 'app/_comercial/comercialClientesAsignados.php';
                    break;
                case '3':
                    location.href = 'app/_usuario/usuarioFinal.html';
                    break;
            }
            const saludo = document.querySelector('.Greeting');
            saludo.textContent = `Buenos días, ${nombre}!`;
        } else {
            output.innerText = "Credenciales no válidas";
            output.classList.add("error");
        }
    } else {
        output.innerText = "Error en la petición";
        output.classList.add("error");
    }
}

document.getElementById("login-form").addEventListener('submit', login);

// Actualiza el nombre de usuario en la sección correspondiente
const outputNombreUsuario = document.getElementById("nombreUsuario");
if (outputNombreUsuario) {
    outputNombreUsuario.innerText = nombreUsuario;
}
