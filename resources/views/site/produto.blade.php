@extends('index')
@section('titulo', $produto->nome . ' | General Goods')

@php
    use App\Models\Fornecedor;
    $fornecedores = Fornecedor::all();
@endphp

@section('conteudo')
<main class="container-md my-5">
    <section class="gg-bg-light p-4 rounded-lg">
        <h2 class="text-dark text-center">{{$produto->nome}}</h2>
    </section>
    <section class="my-4 px-4 py-2 border rounded">
        <div class="row justify-content-start align-items-center m-0 p-0 my-3">
            <div class="col-12 col-md-8 offset-md-2 p-0 text-center">
                <h1>Dados do Produto</h1>
            </div>
            @auth
            <div class="col col-md-2 row justify-content-end m-0 p-0 my-3">
                <button class="mx-1 btn btn-primary gg-alterar-produto-label" onclick="toggleHidden('.gg-alterar-produto-input', '.gg-alterar-produto-label')" data-toggle="tooltip" data-placement="top" title="Editar">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="mx-1 btn btn-primary gg-alterar-produto-input" hidden onclick="toggleHidden('.gg-alterar-produto-label', '.gg-alterar-produto-input')" data-toggle="tooltip" data-placement="top" title="Cancelar">
                    <i class="fas fa-times"></i>
                </button>
                <form action="{{route('produto', ['id' => $produto->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mx-1 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
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
            <form action="{{route('produto', ['id' => $produto->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @endauth
                <li class="row m-0 p-0 my-2 gg-alterar-produto-label">
                    <div class="col-5 col-md-3 col-lg-2 row justify-content-center bg-white rounded m-0 p-0" href="{{ route('produto', ['id' => $produto->id]) }}">
                        <img src="/storage/img/{{$produto->imagem}}" alt="Imagem do {{$produto->nome}}" class="gg-posicao-imagem-contain w-100 rounded" height="133">
                    </div>
                </li>
                @auth
                <li class="row align-items-end gg-alterar-produto-input p-0 m-0 my-2" hidden>
                    <div class="col-5 col-md-3 col-lg-2 row justify-content-center bg-white rounded m-0 p-0" href="{{ route('produto', ['id' => $produto->id]) }}">
                        <img src="/storage/img/{{$produto->imagem}}" alt="Imagem do {{$produto->nome}}" class="gg-posicao-imagem-contain w-100 rounded" id="gg-produto-imagem-preview" height="133">
                    </div>
                    <input type="file" name="imagem" class="form-control-file gg-border-primary col mx-2 my-2 p-2 rounded" id="gg-upload-produto-imagem" value="{{$produto->imagem}}" placeholder="{{$produto->imagem}}">
                </li>
                @endauth
                <li class="row m-0 p-0 my-2 gg-alterar-produto-label">
                    <strong class="col-5 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded">
                        Nome
                    </strong>
                    <span class="col mx-2 p-2 rounded">{{$produto->nome}}</span>
                </li>
                @auth
                <li class="row align-items-center gg-alterar-produto-input p-0 m-0 my-2" hidden>
                    <label class="col-5 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded mb-0" for="#gg-produto-nome-input">
                        <strong>Nome</strong>
                    </label>
                    <input type="text" name="nome" class="form-control gg-border-primary col mx-2 p-2 rounded" id="gg-produto-nome-input" value="{{$produto->nome}}" placeholder="{{$produto->nome}}" minlength="3" maxlength="50" required>
                </li>
                @endauth
                <li class="row m-0 p-0 my-2 gg-alterar-produto-label">
                    <strong class="col-5 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded">
                        Quantidade
                    </strong>
                    <span class="col mx-2 p-2 rounded">{{$produto->quantidade}}</span>
                </li>
                @auth
                <li class="row align-items-center gg-alterar-produto-input p-0 m-0 my-2" hidden>
                    <label class="col-5 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded mb-0" for="#gg-produto-quantidade-input">
                        <strong>Quantidade</strong>
                    </label>
                    <input type="number" class="form-control gg-border-primary col mx-2 p-2 rounded" name="quantidade" id="gg-produto-quantidade-input" value="{{$produto->quantidade}}" min="0" required>
                </li>
                <li class="row align-items-center gg-alterar-produto-input p-0 m-0 my-2" hidden>
                    <label class="col-5 col-md-3 col-lg-2 text-center gg-bg-primary p-2 rounded mb-0" for="#gg-produto-fornecedor-input">
                        <strong>Fornecedor</strong>
                    </label>
                    <select class="form-control gg-border-primary col mx-2 p-2 rounded" name="fornecedor" id="gg-produto-fornecedor-input" required>
                        @foreach ($fornecedores as $fornecedor)
                        <option value="{{$fornecedor->id}}" {{($fornecedor == $produto->fornecedor) ? 'selected' : ''}}>
                            {{$fornecedor->nome}}
                        </option>
                        @endforeach
                    </select>
                </li>
                @endauth
                @auth
                <div class="gg-alterar-produto-input row justify-content-center align-items-center p-0 m-0" hidden>
                    <button type="submit" class="btn btn-outline-dark col-6 my-2">Alterar</button>
                </div>
            </form>
            @endauth
        </div>
    </section>
    <section class="my-4 px-4 py-2 border rounded">
        <div class="row justify-content-start align-items-center m-0 p-0 my-3">
            <div class="col-12 col-md-8 offset-0 offset-md-2 p-0 text-center">
                <h1>Dados do Fornecedor</h1>
            </div>
            <div class="col col-md-2 row justify-content-end m-0 p-0 my-2 my-md-0">
                <a class="mx-1 btn btn-primary" href="{{route('fornecedor',['id' => $produto->fornecedor->id])}}" data-toggle="tooltip" data-placement="top" title="Acessar">
                    <i class="fas fa-link"></i>
                </a>
            </div>
        </div>
        <ul class="list-unstyled">
            <li class="row m-0 p-0 my-2">
                <strong class="col-5 col-md-3 col-lg-2 text-center gg-border-primary p-2 rounded">
                    Nome
                </strong>
                <span class="col mx-2 p-2 rounded">{{$produto->fornecedor->nome}}</span>
            </li>
            <li class="row m-0 p-0 my-2">
                <strong class="col-5 col-md-3 col-lg-2 text-center gg-border-primary p-2 rounded">
                    Telefone
                </strong>
                <span class="col mx-2 p-2 rounded">{{$produto->fornecedor->getTelefone()}}</span>
            </li>
            <li class="row m-0 p-0 my-2">
                <strong class="col-12 col-md-3 col-lg-2 text-center gg-border-primary p-2 rounded">
                    Endereço
                </strong>
                <span class="col mx-2 p-2 rounded">{{$produto->fornecedor->getEnderecoCompleto()}}</span>
            </li>
        </ul>
    </section>
</main>
@endsection

@section('css')
<link rel="stylesheet" href="/css/produtos.css">
@endsection

@section('scripts')
<script src="/js/imagem-preview.js"></script>
@endsection
