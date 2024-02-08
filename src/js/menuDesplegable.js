/*const menu = document.getElementById("menu-principal");

document.querySelector(".hamburguesa").addEventListener("click", () => {
    menu.classList.toggle("active");
});

document.querySelectorAll("#menu-principal ul a").forEach((enlace) => {
    enlace.addEventListener("click", () => {
        menu.classList.remove("active");
    });
});

const currentPage = "index";
const currentPageElement = document.querySelector(`#menu-principal a[href="${currentPage}.html"]`);
currentPageElement.classList.add("active");
*/
const menu = document.getElementById("menu-principal");

document.querySelector(".hamburguesa").addEventListener("click", () => {
    menu.classList.toggle("active");
});

document.querySelectorAll("#menu-principal ul a").forEach((enlace) => {
    enlace.addEventListener("click", () => {
        menu.classList.remove("active");
    });
});

const currentPage = "index";
const currentPageElement = document.querySelector(`#menu-principal a[href="${currentPage}.html"]`);
currentPageElement.classList.add("active");

// Evento para el icono de inicio de sesión
const loginIcon = document.getElementById("login-icon");
