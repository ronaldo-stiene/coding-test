@extends('index')
@section('titulo', 'Estoque | General Goods')

@section('conteudo')
<main class="container-md my-2 my-md-5">
    <section>
        <div class="row justify-content-center m-0 p-0">
            <h2 class="col offset-0 offset-sm-3 offset-lg-2 text-center my-3 my-md-4">Estoque</h2>
            <ul class="col-12 col-sm-3 col-lg-2 row justify-content-center align-items-center nav nav-pills m-0 my-2 p-0" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ ($visualizacao == "detalhes") ? "active" : "" }}" href="{{ route('estoque') }}?page={{ $produtos->currentPage() }}&view=detalhes">
                        <i class="fas fa-th-list"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($visualizacao == "lista") ? "active" : "" }}" href="{{ route('estoque') }}?page={{ $produtos->currentPage() }}&view=lista">
                        <i class="fas fa-list"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($visualizacao == "grade") ? "active" : "" }}" href="{{ route('estoque') }}?page={{ $produtos->currentPage() }}&view=grade">
                        <i class="fas fa-th"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            @include('site.estoque.' . $visualizacao)
        </div>
    </section>
    <section>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ ($produtos->onFirstPage()) ? "disabled" : ""}}">
                    <a class="page-link" href="{{ $produtos->previousPageUrl() }}&view={{$visualizacao}}" tabindex="-1" aria-disabled="true">Anterior</a>
                </li>
                @for ($i = 1; $i <= $produtos->lastPage(); $i++)
                @if ($i == $produtos->currentPage())
                <li class="page-item active"><a class="page-link">{{$i}}</a></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $produtos->url($i) }}&view={{$visualizacao}}">{{$i}}</a></li>
                @endif
                @endfor
                <li class="page-item {{ (! $produtos->hasMorePages()) ? "disabled" : ""}}">
                    <a class="page-link" href="{{ $produtos->nextPageUrl() }}&view={{$visualizacao}}">Próximo</a>
                </li>
            </ul>
        </nav>
    </section>
</main>
@endsection

@section('css')
<link rel="stylesheet" href="/css/bootstrap/paginationColor.css">
<link rel="stylesheet" href="/css/bootstrap/pillsTabColor.css">
<link rel="stylesheet" href="/css/estoque.css">
@endsection

@section('scripts')
@endsection
