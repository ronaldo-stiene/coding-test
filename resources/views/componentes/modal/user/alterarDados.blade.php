<form action="{{route('user')}}" method="post">
    @csrf
    <li class="row m-0 p-0 my-2 gg-alterar-user-label">
        <strong class="col-3 text-center gg-border-primary p-2 rounded">Nome</strong>
        <span class="col mx-2 p-2 rounded">{{Auth::user()->name}}</span>
    </li>
    <li class="row m-0 p-0 my-2 gg-alterar-user-input row align-items-center p-0 m-0" hidden>
        <label class="col-3 text-center gg-border-primary p-2 rounded mb-0" for="#gg-user-name-input">
            <strong>Nome</strong>
        </label>
        <input type="text" name="name" class="form-control col mx-2 p-2 rounded" id="gg-user-name-input" value="{{Auth::user()->name}}">
    </li>
    <li class="row m-0 p-0 my-2 gg-alterar-user-label">
        <strong class="col-3 text-center gg-border-primary p-2 rounded">E-Mail</strong>
        <span class="col mx-2 p-2 rounded">{{Auth::user()->email}}</span>
    </li>
    <li class="row m-0 p-0 my-2 gg-alterar-user-input row align-items-center p-0 m-0" hidden>
        <label class="col-3 text-center gg-border-primary p-2 rounded mb-0" for="#gg-user-email-input">
            <strong>E-Mail</strong>
        </label>
        <input type="email" name="email" class="form-control col mx-2 p-2 rounded" id="gg-user-email-input" value="{{Auth::user()->email}}">
    </li>
    <div class="gg-alterar-user-input row justify-content-center align-items-center p-0 m-0" hidden>
        <input type="hidden" name="id" value="{{Auth::id()}}">
        <button type="submit" class="btn btn-outline-dark col-6">Alterar</button>
    </div>
</form>

