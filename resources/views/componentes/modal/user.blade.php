@php
    use App\User;
    $users = User::all();
@endphp
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header gg-bg-light">
            <h5 class="modal-title" id="gg-modal-usuario-label">Usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3 pb-2 border-bottom">
                <div class="row align-items-center m-0 p-0">
                    <div class="col-2">
                        <span class="fas fa-user-circle display-4 gg-txt-primary"></span>
                    </div>
                    <div class="col">
                        <h5 class="mb-0">{{Auth::user()->name}}</h5>
                        @if (Auth::user()->admin)
                        <small class="muted">Admin</small>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="row justify-content-end m-0 p-0">
                    <button class="btn btn-link text-decoration-none text-dark gg-alterar-user-label" onclick="toggleHidden('.gg-alterar-user-input', '.gg-alterar-user-label')">
                        Editar
                    </button>
                    <button class="btn btn-link text-decoration-none text-dark gg-alterar-user-input" hidden onclick="toggleHidden('.gg-alterar-user-label', '.gg-alterar-user-input')">
                        Cancelar
                    </button>
                </div>
                <ul class="list-unstyled">
                    @include('componentes.modal.user.alterarDados')
                    <li class="row m-0 p-0 my-2">
                        @include('componentes.modal.user.alterarSenha')
                    </li>
                    @if (Auth::user()->admin)
                    <li class="row m-0 p-0 my-2">
                        @include('componentes.modal.user.criarUser')
                    </li>
                    <li class="row m-0 p-0 my-2">
                        @include('componentes.modal.user.administrarUser')
                    </li>
                    @endif
                    <li class="row m-0 p-0 my-2">
                        <a href="{{route('logout')}}" class="col-12 text-center-0 p-2 my-1 btn btn-dark">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal-footer gg-bg-light">
            <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>