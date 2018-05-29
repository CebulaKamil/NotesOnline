$(document).ready(function(){
    // Hide and show menu
    const navList = $(".nav-list");
    const btnHamburger = $(".hamburger");

    const showMenu = function() {
        btnHamburger.toggleClass(" hamburger-active");
        navList.toggleClass(" open");
        navList.animate({display: 'block'});
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
});