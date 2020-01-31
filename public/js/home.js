$(document).ready(function () {

    /**
     * Modifica a seta quando o mouse está em cima do elemento.
     * 
     * @author Ronaldo Stiene <rstiene27@gmail.com>
     * @since 28/01/2020
     */
    $('.gg-home-card').hover( function() {
        $(this).find('.gg-home-card-image').addClass("hover");
        $(this).find('.gg-arrow-home').addClass("hover");
    }, function () {
        $(this).find('.gg-home-card-image').removeClass("hover");
        $(this).find('.gg-arrow-home').removeClass("hover");
    });

});