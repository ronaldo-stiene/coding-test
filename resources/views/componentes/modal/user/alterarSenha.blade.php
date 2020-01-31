<button class="col-12 text-center-0 p-2 my-1 gg-btn-outline-primary" data-toggle="collapse" data-target="#tl-alterar-senha">
    <p class="mb-0">Alterar Senha</p>
</button>
<div class="collapse col" id="tl-alterar-senha">
    <div class="card card-body">
        <form action="{{route('alterar-senha')}}" method="POST">
            @csrf
            <input type="password" class="form-control col my-2" name="password" placeholder="Insira a senha" minlength="4" maxlength="20" required>
            <input type="password" class="form-control col my-2" name="confirmaPassword" placeholder="Confirme a senha" minlength="4" maxlength="20" required>
            <small id="passwordHelpBlock" class="form-text text-muted ml-2">
                A senha deve ter entre 4 e 20 caracteres.
            </small>
            <input type="hidden" name="id" value="{{Auth::id()}}">
            <button type="submit" class="btn btn-outline-dark col-12 my-2">Alterar</button>
        </form>
    </div>
</div>