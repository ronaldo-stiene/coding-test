$(document).ready(function () {

    /**
     * Modifica a seta quando o mouse está em cima do elemento.
     */
    $('.gg-home-card').hover( function() {
        $(this).find('.gg-home-card-image').addClass("hover");
        $(this).find('.gg-arrow-home').addClass("hover");
    }, function () {
        $(this).find('.gg-home-card-image').removeClass("hover");
        $(this).find('.gg-arrow-home').removeClass("hover");
    });

});