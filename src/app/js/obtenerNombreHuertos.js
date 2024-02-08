// Obtener el elemento select
const selectHuertos = document.getElementById('Huetos');

// Hacer la petición al servidor para obtener los nombres de los huertos
fetch('../../api/obtenerNombresHuertos.php')
    .then(response => response.json())
    .then(data => {
        // Generar las opciones del select
        console.log(data);
        const selectHuertosUno = document.getElementById('Huertos1'); // Seleccionar el elemento select por su id
        const selectHuertosDos = document.getElementById('Huertos2');

        // Limpiar opciones existentes
        selectHuertosUno.innerHTML = '';
        selectHuertosDos.innerHTML = '';

        // Generar las opciones del select
        data.forEach(nombreHuerto => {
            const option = document.createElement('option');
            option.value = nombreHuerto;
            option.textContent = nombreHuerto;
            selectHuertosUno.appendChild(option);
            selectHuertosDos.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error al obtener los nombres de los huertos:', error);
    });