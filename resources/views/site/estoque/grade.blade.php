<div class="row justify-content-center row-cols-1 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 mx-3 mx-sm-0 my-4">
    @foreach ($produtos as $produto)
    <div class="card mx-2 col p-0 my-2 gg-btn-outline-light">
        <div class="card-img-top bg-white rounded row justify-content-center m-0 p-2">
            <img src="/storage/img/{{$produto->imagem}}" alt="Imagem da {{$produto->nome}}" class="gg-posicao-imagem-estoque gg-max-h-5">
        </div>
        <div class="card-body">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h6 class="card-title mb-0">{{$produto->nome}}</h6>
                @if ($produto->quantidade <= 3) 
                <small class="text-danger gg-pisca-animation">
                    <i class="fas fa-exclamation-circle"></i>
                    <span class="d-none d-md-inline">Produto prestes a acabar!</span>
                </small>
                @endif
            </div>
        </div>
        <div class="text-center rounded row justify-content-center align-items-center border-top text-dark bg-white m-0 p-0 gg-h-6">
            <div class="col-6 bg-light align-self-stretch d-none d-lg-flex align-items-center">
                <div>Fornecedor</div>
            </div>
            <div class="col text-center">
                {{ $produto->fornecedor->nome }}
            </div>
        </div>
        <div class="text-center rounded row justify-content-center align-items-center border-top text-dark bg-white m-0 p-0">
            <div class="col-6 bg-light rounded align-self-stretch d-none d-lg-flex align-items-center">
                <div>Quantidade</div>
            </div>
            <div class="col text-center display-4 {{ ($produto->quantidade <= 3) ? "gg-bg-transparent-danger" : "" }}">
                {{$produto->quantidade}}
            </div>
            <a href="{{ route('produto', ['id' => $produto->id]) }}" class="stretched-link"></a>
        </div>
    </div>
    @endforeach
</div>