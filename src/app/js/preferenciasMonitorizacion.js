const popuppreferencias = document.getElementById('popuppreferencias');
const popuppreferenciaslimites = document.getElementById('popuppreferencias-li');
const popuppreferenciasrenombrar = document.getElementById('popuppreferencias-re');

const botonmovil = document.getElementById('ajustesmovil');
const botondesktop = document.getElementById('ajustesdesktop')
//const botonpreferencias = document.querySelector('.Ajustes');
const cerrar = document.querySelector('.cerrarpopup');
const botonlimites = document.getElementById('boton-limites');
const botonrenombrar = document.getElementById('boton-renombrar');
//se recogen los identificadores de la maquetacion y se agrega un listener para escuchar
//cuando el usuario hace click y se debe mostrar o cerrar el pop up

var ultimodialogabierto = null;
//se establece una variable para poder reconocer que pop up cerrar al momento de darle al
//boton de cerrar, de tal forma que si accedes a un pop up hijo vas a poder cerrar este
//nuevo pop up y ademas se guardara en la variable que la siguiente ves que cierres
//sera al pop up padre

botonmovil.addEventListener('click', () => {
    popuppreferencias.showModal();
    popuppreferencias.style.display = "block";
    ultimodialogabierto = popuppreferencias;
});

botondesktop.addEventListener('click', () => {
    popuppreferencias.showModal();
    popuppreferencias.style.display = "block";
    ultimodialogabierto = popuppreferencias;
});

cerrar.addEventListener('click', () => {
    if (ultimodialogabierto === popuppreferencias) {
        ultimodialogabierto.close();
        ultimodialogabierto.style.display = "none";
        ultimodialogabierto = null;
    } else {
        ultimodialogabierto.close();
        ultimodialogabierto = popuppreferencias;
    }
}); //aqui se confirma lo dicho en el anterior comentario, depende de cual cierres la variable
//tendra un valor u otro, quedando como nula al cerrar al pop up padre

botonlimites.addEventListener('click', () => {
    popuppreferenciaslimites.showModal();
    ultimodialogabierto = popuppreferenciaslimites;
    popuppreferenciaslimites.style.display = "block";
});

const guardarlimites = document.getElementById('guardarlimites');

guardarlimites.addEventListener('click', () => {
    popuppreferenciaslimites.close();
    popuppreferenciaslimites.style.display = "none";
});

botonrenombrar.addEventListener('click', () => {
    popuppreferenciasrenombrar.showModal();
    ultimodialogabierto = popuppreferenciasrenombrar;
});

const guardarrenombrar = document.getElementById('guardarrenombrar');
guardarrenombrar.addEventListener('click', (event) => {
    event.preventDefault();

    const nuevoNombreHuerto = document.getElementsByName('nombrehuertonuevo')[0].value;

    // Realiza la llamada a la API utilizando PeticionRest
    const peticion = new PeticionRest();
    peticion.put('/api/huertos/' + idHuerto, { nombre: nuevoNombreHuerto })
        .then(response => {
            // Lógica para manejar la respuesta de la solicitud
            if (response.ok) {
                console.log('El nombre del huerto se actualizó correctamente.');
            } else {
                console.log('Error al actualizar el nombre del huerto.');
            }
        })
        .catch(error => {
            console.log('Error en la solicitud PUT:', error);
        });

    popuppreferenciasrenombrar.close();
});
//Agrega un evento para actualizar ultimodialogabierto cuando se cierra un popup hijo
popuppreferencias.addEventListener('close', () => {
    ultimodialogabierto = null;
});
popuppreferenciaslimites.addEventListener('close', () => {
    ultimodialogabierto = popuppreferencias;
});
popuppreferenciasrenombrar.addEventListener('close', () => {
    ultimodialogabierto = popuppreferencias;
});