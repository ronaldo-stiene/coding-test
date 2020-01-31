@foreach ($produtos as $produto)
<div class="col-12 row justify-content-between m-0 p-0 my-2 gg-btn-outline-light rounded">
    <a class="col-2 row justify-content-center border-right bg-white rounded m-0 p-1 mr-3" href="{{ route('produto', ['id' => $produto->id]) }}">
        <img src="/storage/img/{{$produto->imagem}}" alt="Imagem da {{$produto->nome}}" class="gg-posicao-imagem-contain w-100">
    </a>
    <div class="col p-0 gg-produto-detalhes-h">
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
            @if ($produto->quantidade <= 3 && $produto->quantidade !== 0) 
            <small class="text-danger my-auto mx-2 gg-pisca-animation">
                <i class="fas fa-exclamation-circle"></i>
                <span class="d-none d-md-inline">Produto prestes a acabar!</span>
            </small>
            @endif
            @if ($produto->quantidade === 0) 
            <small class="text-danger my-auto mx-2 gg-pisca-animation">
                <i class="fas fa-exclamation-circle"></i>
                <span class="d-none d-md-inline">Produto esgotado!</span>
            </small>
            @endif
        </div>
        <div class="text-secondary text-decoration-none">
            <p class="mb-0">
                <span>{{ $produto->fornecedor->nome }}</span>
                <span class="d-none d-md-inline"> - {{ preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '(${1}) ${2}-${3}', $produto->fornecedor->telefone) }}</span>
            </p>
            <p class="mb-0 d-none d-lg-block">
                CEP: {{ preg_replace(
                    '/(\d{5})(\d{3})/', '${1}-${2}', 
                    str_pad($produto->fornecedor->getEndereco()->cep, 
                    8, 
                    0, 
                    STR_PAD_LEFT
                )) }}
            </p>
            <p class="mb-0 d-none d-md-block">
                {{ ucfirst($produto->fornecedor->getEndereco()->rua) . ", " . 
                   $produto->fornecedor->getEndereco()->numero . " - " . 
                   ucfirst($produto->fornecedor->getEndereco()->cidade) . " - " . 
                   strtoupper($produto->fornecedor->getEndereco()->estado) 
                }}
            </p>
        </div>
        <a href="{{ route('produto', ['id' => $produto->id]) }}" class="stretched-link"></a>
    </div>
    <div class="col-3 col-md-2 text-center rounded d-flex flex-column border-left text-dark bg-white p-0">
        <div class="flex-fill d-none d-lg-flex justify-content-center align-items-center bg-light rounded">
            <span>Quantidade</span>
        </div>
        <div class="flex-fill d-flex justify-content-center align-items-center {{ ($produto->quantidade <= 3) ? "gg-bg-transparent-danger" : "" }}">
            <div class="text-center p-3 display-4">
                {{$produto->quantidade}}
            </div>
        </div>
        <a href="{{ route('produto', ['id' => $produto->id]) }}" class="stretched-link"></a>
    </div>
</div>
@endforeach