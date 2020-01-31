<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header gg-bg-light">
            <h5 class="modal-title" id="gg-modal-usuario-label">Criar Fornecedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('criar-fornecedor')}}" method="POST" onsubmit="unmaskFornecedor()">
                @csrf
                <div class="row justify-content-center align-content-center m-0 p-0 my-3">
                    <h3 class="text-center">Dados</h3>
                    <input type="text" class="form-control col-12 my-2" name="nome" placeholder="Nome*" minlength="3" maxlength="50" required>
                    <input type="text" class="form-control col-12 my-2" id="gg-fornecedor-telefone-input" name="telefone" placeholder="Telefone*" required>
                    <h3 class="text-center">Endereço</h3>
                    <input type="text" class="form-control col-12 my-2" id="gg-fornecedor-cep-input" name="cep" placeholder="CEP*" required>
                    <input type="text" class="form-control col-8 my-2" name="rua" placeholder="Rua*" minlength="3" maxlength="50" required>
                    <input type="text" class="form-control col-3 offset-1 my-2" name="numero" placeholder="Número*" maxlength="5" required>
                    <input type="text" class="form-control col-12 my-2" name="complemento" placeholder="Complemento" maxlength="20">
                    <input type="text" class="form-control col-8 my-2" name="cidade" placeholder="Cidade*" minlength="3" maxlength="50" required>
                    <input type="text" class="form-control col-3 offset-1 my-2" id="gg-fornecedor-estado-input" name="estado" placeholder="Estado*" minlength="2" required>
                </div>
                <div class="pl-3 my-3">
                    <small class="text-muted">* Campo obrigatório</small>
                </div>
                <button type="submit" class="btn btn-outline-dark col-12">Criar</button>
            </form>
        </div>
        <div class="modal-footer gg-bg-light">
            <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>