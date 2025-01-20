document.addEventListener("DOMContentLoaded", function () {

    var menu_button = document.getElementById('menu_button');
    var logo = document.getElementById('logo');
    var current_page = document.getElementById('current_page');

    var menu = document.getElementById('menu');

    var menu_button_anim = document.querySelector('.bg_menu_top');

    //================== Affichage nav menu ==================
    menu_button.addEventListener('click', function (event) {
        event.stopPropagation();
        menu_button_anim.classList.add('open');
        if (!menu.classList.contains('menu_open')) {
            menu.classList.add('menu_open');
        } else {
            menu.classList.remove('menu_open');;
        }
    });
    menu_button_anim.addEventListener('animationend', function () {
        menu_button_anim.classList.remove('open');
    });

    document.addEventListener('click', function (event) {
        // Vérifier si le clic n'a pas eu lieu sur le menu ou le bouton
        if (!menu.contains(event.target) && !menu_button.contains(event.target)) {
            if (menu.classList.contains('menu_open')) {
                menu.classList.remove('menu_open');
            }
        }
    });

    //================== Masquer nav scroll ==================
    window.addEventListener('scroll', function () {
        if (window.scrollY > 300 && menu.style.display !== 'block') {
            logo.classList.add('nav_hide');
            current_page.classList.add('nav_hide');
        } else {
            logo.classList.remove('nav_hide');
            current_page.classList.remove('nav_hide');
        }
    });

    //================== Retour au formulaire ==================
    // Sélectionner tous les formulaires sur la page
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        // Ajouter un événement submit à chaque formulaire
        form.addEventListener("submit", function () {
            // Sauvegarder la position actuelle de scroll avant l'envoi du formulaire
            localStorage.setItem("scrollPosition", window.scrollY);
        });
    });

    // Restaurer la position de scroll lors du chargement de la page
    const scrollPosition = localStorage.getItem("scrollPosition");
    if (scrollPosition) {
        window.scrollTo(20, scrollPosition);
        localStorage.removeItem("scrollPosition"); // Supprimer après utilisation
    }

});