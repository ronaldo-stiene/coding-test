<button class="col-12 text-center-0 p-2 my-1 gg-btn-outline-primary" data-toggle="collapse" data-target="#tl-criar-usuario">
    <p class="mb-0">Criar Usuário</p>
</button>
<div class="collapse col" id="tl-criar-usuario">
    <div class="card card-body">
        <form action="{{route('criar-user')}}" method="POST">
            @csrf
            <input type="text" class="form-control col my-2" name="name" placeholder="Nome">
            <input type="text" class="form-control col my-2" name="email" placeholder="E-Mail">
            <input type="password" class="form-control col my-2" name="password" placeholder="Senha">
            @if (Auth::user()->admin)
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="admin" value="true" id="tl-checkbox-admin">
                <label class="form-check-label" for="tl-checkbox-admin">Administrador</label>
            </div>
            @else
            <input type="hidden" name="admin" value="0">
            @endif
            <button type="submit" class="btn btn-outline-dark col-12">Criar</button>
        </form>
    </div>
</div>