$(document).ready(function(){

// Active type
    const listItem = $(".list-item");

    const active = function() {
        listItem.removeClass(' active');
        $(this).toggleClass(' active');
    };

    for(i=0; i < listItem.length; i++) {
        listItem[i].addEventListener("click", active);
    }

});