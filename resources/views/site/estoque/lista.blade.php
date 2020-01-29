@foreach ($produtos as $produto)
<div class="row justify-content-between m-0 my-2 gg-btn-outline-light">
    <a class="col-2 row justify-content-center border-right bg-white rounded m-0 p-0 p-3 h-auto" href="{{ route('produto', ['id' => $produto->id]) }}">
            <img src="/storage/img/{{$produto->imagem}}" alt="Imagem da {{$produto->nome}}" class="gg-posicao-imagem-estoque gg-max-w-2">
    </a>
    <div class="col p-0 ml-3 gg-h-5">
        <div class="row justify-content-start m-0 my-1 my-md-2">
            <h4 class="my-auto d-none d-md-block">
                <a class="text-dark text-decoration-none" href="{{ route('produto', ['id' => $produto->id]) }}">
                    {{$produto->nome}}
                </a>
            </h4>
            <h6 class="my-auto d-block d-md-none">
                <a class="text-dark text-decoration-none" href="{{ route('produto', ['id' => $produto->id]) }}">
                    {{$produto->nome}}
                </a>
            </h6>
            @if ($produto->quantidade <= 3) 
            <small class="text-danger my-auto mx-2 gg-pisca-animation">
                <i class="fas fa-exclamation-circle"></i>
                <span class="d-none d-md-inline">Produto prestes a acabar!</span>
            </small>
            @endif
        </div>
        <div class="text-secondary text-decoration-none" href="{{ route('fornecedor', ['id' => $produto->fornecedor->id]) }}">
            <p class="mb-0">
                <span>{{ $produto->fornecedor->nome }}</span>
            </p>
        </div>
        <a href="{{ route('produto', ['id' => $produto->id]) }}" class="stretched-link"></a>
    </div>
    <div class="col-3 col-md-2 text-center rounded row justify-content-center align-items-center border-left text-dark bg-white m-0 p-0">
        <div class="col-auto bg-light align-self-stretch d-none d-lg-flex align-items-center">
            <div>QTD</div>
        </div>
        <div class="col align-self-stretch d-flex align-items-center justify-content-center display-4 {{ ($produto->quantidade <= 3) ? "gg-bg-transparent-danger" : "" }}">
            {{$produto->quantidade}}
        </div>
        <a href="{{ route('produto', ['id' => $produto->id]) }}" class="stretched-link"></a>
    </div>
</div>
@endforeach