<button class="col-12 text-center-0 p-2 my-1 gg-btn-outline-primary" data-toggle="collapse" data-target="#tl-alterar-senha">
    <p class="mb-0">Alterar Senha</p>
</button>
<div class="collapse col" id="tl-alterar-senha">
    <div class="card card-body">
        <form action="{{route('alterar-senha')}}" method="POST">
            @csrf
            <input type="password" class="form-control col my-2" name="password" placeholder="Insira a senha">
            <input type="password" class="form-control col my-2" name="confirmaPassword" placeholder="Confirme a senha">
            <input type="hidden" name="id" value="{{Auth::id()}}">
            <button type="submit" class="btn btn-outline-dark col-12">Alterar</button>
        </form>
    </div>
</div>