<nav class="container-md navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand gg-title-font" href="{{ route('home') }}">General Goods</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('estoque') }}">Estoque</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('fornecedores') }}">Fornecedores</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('produtos') }}">Produtos</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            @if (!Auth::check())
                <a href="{{ route('login') }}" class="btn btn-outline-dark rounded">
                    <i class="fas fa-user"></i>
                </a>
            @endif
            @auth
            @include('componentes.mensagens.error')
            @include('componentes.mensagens.sucesso')
            <button type="button" class="btn btn-dark rounded" data-toggle="modal" data-target="#userModal">
                <i class="fas fa-user"></i>
            </button>
            <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                @include('componentes.modal.user')
            </div>
            @endauth
        </ul>
    </div>
</nav>