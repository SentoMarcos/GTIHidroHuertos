const elm = document.querySelectorAll('.carrusel img');
let posImagen = 0;

function mostrarImagen(posicion) {
    elm.forEach(image => image.classList.remove('active'));
    elm[posicion].classList.add('active');
}

function otraImagen(siguiente) {
    if (siguiente === true) {
        posImagen++;
        if (posImagen >= elm.length) {
            posImagen = 0;
        }
    } else {
        posImagen--;
        if (posImagen < 0) {
            posImagen = elm.length - 1;
        }
    }
    mostrarImagen(posImagen);
}

document.querySelector('#siguiente').addEventListener('click', function() {
    otraImagen(true);
});

document.querySelector('#anterior').addEventListener('click', function() {
    otraImagen(false);
});



const menu = document.getElementById("menu-principal");

document.querySelector(".hamburguesa").addEventListener("click",() => {menu.classList.toggle("active");})

document.querySelectorAll("#open-menu ul a").forEach(
    (enlace)=>{
        enlace.addEventListener("click",()=>{
            menu.classList.remove("active")
        })
    }
)

const currentPage = "index";
// Obtén el elemento de menú correspondiente a la página actual
const currentPageElement = document.querySelector(`#menu-principal a[href="${currentPage}.html"]`);

// Agrega la clase activa al elemento de menú
currentPageElement.classList.add("active");


