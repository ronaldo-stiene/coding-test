@extends('index')
@section('titulo', 'General Goods')

@php
    $sections = [
        [
            'nome' => 'Estoque',
            'icone' => 'fas fa-clipboard-list',
            'descricao' => 'Visualize os produtos em estoque.',
            'rota' => 'estoque'
        ],
        [
            'nome' => 'Fornecedores',
            'icone' => 'fas fa-people-carry',
            'descricao' => 'Gerencie seus fornecedores.',
            'rota' => 'fornecedores'
        ],
        [
            'nome' => 'Produtos',
            'icone' => 'fas fa-shopping-cart',
            'descricao' => 'Controle os seus produtos.',
            'rota' => 'produtos'
        ],
    ]
@endphp

@section('conteudo')
<main class="container-md my-5">
    <section>
        <h2 class="text-dark text-center">Gerenciamento de Estoque</h2>
    </section>
    <section class="row justify-content-center align-items-start mt-5 mx-2 mx-md-0">
        @foreach ($sections as $section)
        <div class="card gg-home-card col-12 col-md mx-1 mx-lg-2 my-3 my-lg-0 p-0">
            <div class="py-3 gg-btn-primary gg-home-card-image">
                <span class="{{ $section['icone'] }} card-img-top text-center display-3"></span>
            </div>
            <div class="card-body text-center">
                <h4 class="text-center">{{ $section['nome'] }}</h4>
                <p class="card-text mb-0 mb-md-3">{{ $section['descricao'] }}</p>
                <a href="{{ route($section['rota']) }}" class="stretched-link d-block d-md-none"></a>
                <a href="{{ route($section['rota']) }}" class="fas fa-chevron-down text-center stretched-link text-dark text-decoration-none d-none d-md-block gg-arrow-home"></a>
            </div>
        </div>
        @endforeach
    </section>
</main>
@endsection

@section('css')
<link rel="stylesheet" href="/css/home.css">
@endsection

@section('scripts')
<script src="/js/home.js"></script>
@endsection

