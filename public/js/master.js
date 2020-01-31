/**
 * Altera a visualização entre elementos.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */
function toggleHidden(show, hide) {
    $(hide).attr('hidden', true)
    $(show).attr('hidden', false)
}

