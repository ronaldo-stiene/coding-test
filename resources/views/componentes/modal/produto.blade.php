@php
    use App\Models\Fornecedor;
    $fornecedores = Fornecedor::all();
@endphp
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header gg-bg-light">
            <h5 class="modal-title" id="gg-modal-usuario-label">Criar Produto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('criar-produto')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center align-content-center m-0 p-0 my-3">
                    <h3 class="text-center">Produto</h3>
                    <div class="input-group row justify-content-between m-0 p-0 my-3">
                        <div class="col-4 border row m-0 p-0">
                            <img id="gg-produto-imagem-preview" class="gg-posicao-imagem-contain col-12 gg-size-7 p-0 d-none" src="#" alt="Preview">
                        </div>
                        <div class="col-7 row align-items-center m-0 p-0">
                            <div class="custom-file col-12 row m-0 p-0">
                                <input type="file" class="custom-file-input" name="imagem" id="gg-upload-produto-imagem" required>
                                <label class="custom-file-label" for="gg-upload-produto-imagem">Imagem*</label>
                            </div>
                            <input type="text" class="form-control col-12 mt-2" name="nome" placeholder="Nome*" minlength="3" maxlength="50" required>
                        </div>
                    </div>
                    <h3 class="text-center">Fornecedor</h3>
                    <select class="form-control" name="fornecedor" required>
                        <option selected disabled>Fornecedor*</option>
                        @foreach ($fornecedores as $fornecedor)
                        <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                        @endforeach
                    </select>
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