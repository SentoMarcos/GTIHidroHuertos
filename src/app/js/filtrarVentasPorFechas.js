async function filtrarVentasPorFechas(tiposensor, fechaInicio, fechaFin) {
// Construir la URL con los parámetros correspondientes
    let url = `../../api/medidas.php?id_tipo_sensor=${tiposensor}`;

// Verificar si se proporcionaron las fechas de inicio y fin
    if (fechaInicio && fechaFin) {
        // Agregar los parámetros de fecha a la URL
        url += `&fecha-desde=${fechaInicio}&fecha-hasta=${fechaFin}`;
    }

// Realizar la petición a la URL
    fetch(url)
        .then(response => response.json()) // Convertir la respuesta a JSON
        .then(data => {
            // Actualizar la gráfica con los datos filtrados
            actualizarGrafica(data, myChart);
        })
        .catch(error => {
            console.error('Error al filtrar las medidas:', error);
        });
}

<!--script del pop up para filtrar las fechas que indican los datos de la grafica-->
const botonescalendario = document.querySelectorAll('.boton-calendario');
const botonfiltrar = document.getElementById('aceptar-filtrar');
const popup = document.getElementById('popupfiltrar');
const cancelar = document.getElementById('cancelar');
const mensaje = document.getElementById('mensaje');
const fechadesde = document.getElementById('fecha-desde');
const fechahasta = document.getElementById('fecha-hasta');

async function handleBotonCalendarioClick (event) {
    popup.showModal();
    popup.style.display = 'block';

    // Obtener el ID del botón de calendario
    const idBoton = event.target.id;
    // Obtener el número del último carácter de la ID
    const idTipoSensor = idBoton.substr(-1);

    botonfiltrar.addEventListener('click', async () => {
        if (fechadesde.value && fechahasta.value) {
            const datosFiltro = {
                fechaDesde: fechadesde.value,
                fechaHasta: fechahasta.value
            };

            await filtrarVentasPorFechas(idTipoSensor, datosFiltro.fechaDesde, datosFiltro.fechaHasta);

            popup.close();
            popup.style.display = "none";
        } else {
            mensaje.textContent = 'Debe seleccionar ambas fechas';
        }
    });
};


// Agregar un controlador de eventos a cada botón de calendario
botonescalendario.forEach((boton) => {
    boton.addEventListener('click', handleBotonCalendarioClick);
});

cancelar.addEventListener('click', () => {
    popup.close();
    popup.style.display = 'none';
});



