$(document).ready(function(){
// Hide and show menu
    const navList = $(".nav-list");
    const btnHamburger = $(".hamburger");

    const showMenu = function() {
        btnHamburger.toggleClass(" hamburger-active");
        navList.toggleClass(" open");

    };
    btnHamburger[0].addEventListener("click", showMenu);


// Active type
    const listItem = $(".nav-list__item-link");

    const active = function() {
        listItem.removeClass('active');
        $(this).toggleClass(" active");
    };

    for(i=0; i < listItem.length; i++) {
        listItem[i].addEventListener("click", active);
    }


// Modal sigin up
    const siginUp = $(".page-text__buton");
    const modal = $(".modal");
    const canel = $(".form__button--canel");

    const showModal = function() {
        modal.animate({left: '0'});
    }

    const hideModal = function() {
        modal.animate({left: '-100%'});
    }

    siginUp[0].addEventListener("click", showModal);
    canel[0].addEventListener("click", hideModal);


// // Modal login
    const login = $(".nav-list__item-link");
    const loginModal = $(".modal-login");
    const canelLoginModal = $(".form-login__button--canel");

    const showLoginModal = function() {
        loginModal.animate({left: '0'});
    }

    const hideLoginModal = function() {
        loginModal.animate({left: '-100%'});
    }

    login[3].addEventListener("click", showLoginModal);
    canelLoginModal[0].addEventListener("click", hideLoginModal);
});