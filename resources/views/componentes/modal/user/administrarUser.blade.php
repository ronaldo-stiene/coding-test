<button class="col-12 text-center-0 p-2 my-1 gg-btn-outline-primary" data-toggle="collapse" data-target="#tl-administrar-usuários">
    <p class="mb-0">Administrar Usuários</p>
</button>
<div class="collapse col" id="tl-administrar-usuários">
    <div class="card card-body">
        <ul class="list-unstyled">
            @foreach ($users as $user)
                @php
                    if ($user->id == Auth::id()) {
                        continue;
                    }
                @endphp
                <li class="row m-0 p-0 justify-content-between border rounded shadow-sm my-2 p-2">
                    <div class="col">
                        <p class="mb-0">{{$user->name}}</p>
                        <small class="muted">{{' <' . $user->email . '>'}}</small>
                    </div>
                    <div class="col-3 row justify-content-center align-items-center m-0 p-0">
                        <form action="{{route('redefinir-user', ['id' => $user->id])}}" method="post">
                            @csrf
                            <button type="submit" class="mx-1 btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Redefinir senha">
                                <i class="fas fa-redo-alt"></i>
                            </button>
                        </form>
                        <form action="{{route('user')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <button type="submit" class="mx-1 btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir usuário">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>