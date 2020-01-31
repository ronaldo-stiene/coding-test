$(document).ready(function () {

    /**
     * Mostra os produtos no breakpoint md.
     */
    $('.gg-fornecedor-item').hover(function () {
        if ($(window).width() > 768 && $(window).width() < 992) {
            $(this).find('.gg-fornecedor-item-produtos').stop();
            $(this).find('.gg-fornecedor-item-produtos').slideDown();
        }
    }, function () {
        if ($(window).width() > 768 && $(window).width() < 992) {
            $(this).find('.gg-fornecedor-item-produtos').stop();
            $(this).find('.gg-fornecedor-item-produtos').slideUp();
        }
    });
    
});
