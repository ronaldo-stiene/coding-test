@extends('index')
@section('titulo', $fornecedor->nome . ' | General Goods')

@php
$dados = [
    'Nome' => [
        'label' => $fornecedor->nome,
        'input' => $fornecedor->nome,
        'validacoes' => 'minlength="3" maxlength="50" required'
    ],
    'Telefone' => [
        'label' => $fornecedor->getTelefone(),
        'input' => $fornecedor->telefone,
        'validacoes' => 'required'
    ]
];
$endereco = [
    'label' => $fornecedor->getEnderecoCompleto(),
    'input' => [
        'CEP' => $fornecedor->getEndereco()->getCep(),
        'Rua' => $fornecedor->getEndereco()->rua,
        'Número' => $fornecedor->getEndereco()->numero,
        'Complemento' => $fornecedor->getEndereco()->complemento,
        'Cidade' => $fornecedor->getEndereco()->cidade,
        'Estado' => $fornecedor->getEndereco()->estado
    ],
    'validacoes' => [
        'CEP' => 'required',
        'Rua' => 'minlength="3" maxlength="50" required',
        'Número' => 'maxlength="5" required',
        'Complemento' => 'maxlength="20"',
        'Cidade' => 'minlength="3" maxlength="50" required',
        'Estado' => 'minlength="2" required'
    ]

];
@endphp

@section('conteudo')
<main class="container-md my-5">
    <section class="gg-bg-light p-4 rounded-lg">
        <h2 class="text-dark text-center">{{$fornecedor->nome}}</h2>
    </section>
    <section class="my-4 px-4 py-2 border rounded">
        <div class="row justify-content-start align-items-center m-0 p-0 my-3">
            <div class="col-12 col-md-8 offset-md-2 p-0 text-center">
                <h1>Dados do Fornecedor</h1>
            </div>
            @auth
            <div class="col col-md-2 row justify-content-end m-0 p-0 my-3">
                <button class="mx-1 btn btn-primary gg-alterar-fornecedor-label" onclick="toggleHidden('.gg-alterar-fornecedor-input', '.gg-alterar-fornecedor-label')" data-toggle="tooltip" data-placement="top" title="Editar">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="mx-1 btn btn-primary gg-alterar-fornecedor-input" hidden onclick="toggleHidden('.gg-alterar-fornecedor-label', '.gg-alterar-fornecedor-input')" data-toggle="tooltip" data-placement="top" title="Cancelar">
                    <i class="fas fa-times"></i>
                </button>
                <form action="{{route('fornecedor', ['id' => $fornecedor->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mx-1 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
            @endauth
        </div>
        @auth
        <div>
            @include('componentes.alertas.error')
            @include('componentes.alertas.sucesso')
        </div>
        @endauth
        <div>
            @auth
            <form action="{{route('fornecedor', ['id' => $fornecedor->id])}}" method="post">
                @csrf
                @endauth
                @foreach ($dados as $item => $dado)
                <li class="row m-0 p-0 my-2 gg-alterar-fornecedor-label">
                    <strong class="col-5 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded">
                        {{$item}}
                    </strong>
                    <span class="col mx-2 p-2 rounded">{{$dado['label']}}</span>
                </li>
                @auth
                <li class="row m-0 p-0 my-2 gg-alterar-fornecedor-input align-items-center p-0 m-0" hidden>
                    <label class="col-5 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded mb-0" for="#gg-fornecedor-{{strtolower(Helper::removerAcentos($item))}}-input">
                        <strong>
                            {{$item}}
                        </strong>
                    </label>
                    <input type="text" name="{{strtolower(Helper::removerAcentos($item))}}" class="form-control gg-border-primary col mx-2 p-2 rounded" id="gg-fornecedor-{{strtolower(Helper::removerAcentos($item))}}-input" value="{{$dado['input']}}" placeholder="{{$item}}" {{$dado['validacoes']}}>
                </li>
                @endauth
                @endforeach
                <li class="row m-0 p-0 my-2 gg-alterar-fornecedor-label">
                    <strong class="col-12 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded">
                        Endereço
                    </strong>   
                    <span class="col mx-2 p-2 rounded">{{$endereco['label']}}</span>
                </li>
                @foreach ($endereco['input'] as $label => $input)
                @auth
                <li class="row m-0 p-0 my-2 gg-alterar-fornecedor-input align-items-center p-0 m-0" hidden>
                    <label class="col-5 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded mb-0" for="#gg-fornecedor-{{strtolower(Helper::removerAcentos($label))}}-input">
                        <strong>
                            {{$label}}
                        </strong>
                    </label>
                    <input type="text" name="{{strtolower(Helper::removerAcentos($label))}}" class="form-control gg-border-primary col mx-2 p-2 rounded" id="gg-fornecedor-{{strtolower(Helper::removerAcentos($label))}}-input" value="{{$input}}" placeholder="{{$label}}" {{$endereco['validacoes'][$label]}}>
                </li>
                @endauth
                @endforeach
                @auth
                <div class="gg-alterar-fornecedor-input row justify-content-center align-items-center p-0 m-0" hidden>
                    <button type="submit" class="btn btn-outline-dark col-6 mt-2" onclick="unmaskFornecedor()">Alterar</button>
                </div>
            </form>
            @endauth
        </div>
    </section>
    @if ($fornecedor->produtos->count() != 0)
    <section class="my-4 px-4 py-2 border rounded">
        <div class="row justify-content-center align-items-center m-0 p-0 my-3">
            <div class="col-12 p-0 text-center">
                <h1>Produtos</h1>
            </div>
        </div>
        <ul class="list-unstyled">
            @foreach ($fornecedor->produtos as $produto)
            <div class="col-12 row justify-content-between m-0 p-0 my-2 gg-btn-outline-light">
                <div class="col-2 row justify-content-center border-right bg-white rounded m-0 p-0 p-3 h-auto">
                        <img src="/storage/img/{{$produto->imagem}}" alt="Imagem da {{$produto->nome}}" class="gg-posicao-imagem-contain gg-max-w-2">
                </div>
                <div class="col row align-items-center p-0 m-0 ml-3">
                    <div class="row justify-content-start m-0">
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
                    <a href="{{ route('produto', ['id' => $produto->id]) }}" class="stretched-link"></a>
                </div>
            </div>
            @endforeach
        </ul>
    </section>
    @endif
</main>
@endsection

@section('css')
<link rel="stylesheet" href="/css/produtos.css">
@endsection

@section('scripts')
<script src="/js/fornecedorMask.js"></script>
@endsection
