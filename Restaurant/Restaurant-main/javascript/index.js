const mobileMenu = document.getElementById("menu-mobile");
let hiddenMenu = document.getElementById("nav-list");



function displayMenu(){
    hiddenMenu.classList.add("fixed-nav");
    hiddenMenu.classList.remove("nav-list");
}

function removeMenu(){
    hiddenMenu.classList.remove("fixed-nav");
    hiddenMenu.classList.add("nav-list")
}