/**
 * Função que formata o input dos dados do fornecedor.
 * 
 * @use Jquery 1.9.1 $1
 * @author Kevin
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @source https://stackoverflow.com/users/1226546/kevin
 */
$1(window).load(function () {
    var telefones = [{ "mask": "(99) 9999-9999" }, { "mask": "(99) 99999-9999" }];
    var cep = [{ "mask": "99999-999" }];
    var estado = [{ "mask": "AA" }];
    $1('#gg-fornecedor-telefone-input').inputmask({
        mask: telefones,
        greedy: false,
        definitions: { '9': { validator: "[0-9]", cardinality: 1 } }
    });
    $1('#gg-fornecedor-cep-input').inputmask({
        mask: cep,
        greedy: false,
        definitions: { '9': { validator: "[0-9]", cardinality: 1 } }
    });
    $1('#gg-fornecedor-estado-input').inputmask({
        mask: estado,
        greedy: false,
        definitions: { 'A': { validator: "[A-Za-z]", casing: "upper", cardinality: 1 } }
    });
});

/**
 * Função que remove a formatação dos inputs do fornecedor.
 * 
 * @use Jquery 1.9.1 $1
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
function unmaskFornecedor() {
    $1('#gg-fornecedor-telefone-input').inputmask('remove');
    $1('#gg-fornecedor-cep-input').inputmask('remove');
    $1('#gg-fornecedor-estado-input').inputmask('remove');
}