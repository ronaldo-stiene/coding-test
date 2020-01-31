@extends('index')
@section('titulo', 'Fornecedores | General Goods')

@section('conteudo')
<main class="container-md my-5">
    <section>
        <h2 class="text-dark text-center">Fornecedores</h2>
    </section>
    <section class="row {{ (Auth::check()) ? "justify-content-around" : "justify-content-end"}} m-0 p-0 my-3">
        @auth
        <div class="col row justify-content-start align-items-center m-0 p-0">
            <button type="button" class="btn gg-btn-outline-primary rounded" data-toggle="modal" data-target="#fornecedorModal">
                <i class="fas fa-plus mx-2"></i>
                Criar Fornecedor
            </button>
            <div class="modal fade" id="fornecedorModal" tabindex="-1" role="dialog" aria-labelledby="fornecedorModalLabel" aria-hidden="true">
                @include('componentes.modal.fornecedor')
            </div>
        </div>
        @endauth
        <ul class="col row justify-content-end align-items-center nav nav-pills m-0 my-2 p-0" id="pills-tab" role="tablist">
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Detalhes">
                <a class="nav-link {{ ($visualizacao == "detalhes") ? "active" : "" }}" href="{{ route('fornecedores') }}?page={{ $fornecedores->currentPage() }}&view=detalhes">
                    <i class="fas fa-th-list"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Lista">
                <a class="nav-link {{ ($visualizacao == "lista") ? "active" : "" }}" href="{{ route('fornecedores') }}?page={{ $fornecedores->currentPage() }}&view=lista" >
                    <i class="fas fa-list"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Grade">
                <a class="nav-link {{ ($visualizacao == "grade") ? "active" : "" }}" href="{{ route('fornecedores') }}?page={{ $fornecedores->currentPage() }}&view=grade">
                    <i class="fas fa-th"></i>
                </a>
            </li>
        </ul>
    </section>
    <section class="my-3">
        @include('componentes.alertas.error')
        @include('componentes.alertas.sucesso')
    </section>
    <section class="row justify-content-center align-items-center m-0 mt-3 p-0">
        @include('site.fornecedores.' . $visualizacao)
    </section>
    @if ($fornecedores->lastPage() > 1)
    <section class="my-3">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item {{ ($fornecedores->onFirstPage()) ? "disabled" : ""}}">
                    <a class="page-link" href="{{ $fornecedores->previousPageUrl() }}&view={{$visualizacao}}" tabindex="-1" aria-disabled="true">Anterior</a>
                </li>
                @for ($i = 1; $i <= $fornecedores->lastPage(); $i++)
                @if ($i == $fornecedores->currentPage())
                <li class="page-item active"><a class="page-link">{{$i}}</a></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $fornecedores->url($i) }}&view={{$visualizacao}}">{{$i}}</a></li>
                @endif
                @endfor
                <li class="page-item {{ (! $fornecedores->hasMorePages()) ? "disabled" : ""}}">
                    <a class="page-link" href="{{ $fornecedores->nextPageUrl() }}&view={{$visualizacao}}">Próximo</a>
                </li>
            </ul>
        </nav>
    </section>
    @endif
</main>
@endsection

@section('css')
<link rel="stylesheet" href="/css/bootstrap/paginationColor.css">
<link rel="stylesheet" href="/css/bootstrap/pillsTabColor.css">
<link rel="stylesheet" href="/css/fornecedores.css">
@endsection

@section('scripts')
<script src="/js/fornecedorMask.js"></script>
@endsection
