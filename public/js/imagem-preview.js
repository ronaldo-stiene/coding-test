/**
 * Mostra o preview do upload de uma imagem.
 * 
 * @author Ivan Baev 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @source https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
 * @param input 
 */
$("#gg-upload-produto-imagem").change(function () {
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        var fileName = input.files[0].name;

        reader.onload = function (e) {
            $('#gg-produto-imagem-preview').removeClass('d-none');
            $('#gg-produto-imagem-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}