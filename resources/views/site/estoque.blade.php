@extends('index')
@section('titulo', 'Estoque | General Goods')

@section('conteudo')
<main class="container-md my-2 my-md-5">
    <section class="my-3">
        <h2 class="text-dark text-center">Estoque</h2>
    </section>
    <section>
        <div class="table-responsive-md">
        <table class="table table-sm table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center" scope="col" colspan="2">Produto</th>
                    <th class="text-center" scope="col">Fornecedor</th>
                    <th class="text-center" scope="col">Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                <tr class="{{($produto->quantidade <= 3) ? 'gg-bg-transparent-danger': ''}}">
                    <td class="text-center bg-white" scope="row" style="width: 10%">
                        <img class="gg-posicao-imagem-contain gg-max-h-2" src="/storage/img/{{$produto->imagem}}" alt="{{$produto->nome}} imagem">
                    </td>
                    <td class="text-left align-middle" style="width: 50%"> 
                        <a href="{{route('produto', ['id' => $produto->id])}}" class="text-dark text-decoration-none w-100 h-100">
                            <div>
                            {{$produto->nome}}
                            @if ($produto->quantidade <= 3 && $produto->quantidade !== 0) 
                            <small class="text-danger my-auto mx-2 gg-pisca-animation">
                                <i class="fas fa-exclamation-circle"></i>
                                <span class="d-none d-lg-inline">Produto prestes a acabar!</span>
                            </small>
                            @endif
                            @if ($produto->quantidade === 0) 
                            <small class="text-danger my-auto mx-2 gg-pisca-animation">
                                <i class="fas fa-exclamation-circle"></i>
                                <span class="d-none d-lg-inline">Produto esgotado!</span>
                            </small>
                            @endif
                            </div>
                        </a>
                    </td>
                    <td class="text-left align-middle" style="width: 30%"> 
                        <a href="{{route('fornecedor', ['id' => $produto->fornecedor->id])}}" class="text-dark text-decoration-none w-100 h-100">
                            <div>{{$produto->fornecedor->nome}}</div>
                        </a>
                    </td>
                    <td class="text-center align-middle" style="width: 10%">
                        <strong>{{$produto->quantidade}}</strong>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </section>
</main>
@endsection

@section('css')
<link rel="stylesheet" href="/css/produtos.css">
@endsection