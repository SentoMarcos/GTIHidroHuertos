var mobileMenuBtn = document.querySelector("#mobile-menu-btn");
var mobileMenu = document.querySelector(".mobile-menu");

mobileMenuBtn.addEventListener("click", (event) => {
    event.preventDefault();

    if (mobileMenu.style.display === "none") {
        mobileMenu.style.display = "flex";
        mobileMenuBtn.querySelector("img").src = "images_proyecto/icono_cerrar_menu.png";
    } else {
        mobileMenu.style.display = "none";
        mobileMenuBtn.querySelector("img").src = "images_proyecto/menu_logo.png";
    }
});