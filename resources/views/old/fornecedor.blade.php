<div class="row border">
    <div class="col-4">
        <div>{{ $nome }}</div>
        <div>{{ preg_replace('/(\d{5})(\d{3})/', '${1}-${2}', str_pad($endereco->cep, 8, 0, STR_PAD_LEFT)) . ": " . 
                    ucfirst($endereco->rua) . ", " . 
                    $endereco->numero . " - " . 
                    ucfirst($endereco->cidade) . " - " . 
                    strtoupper($endereco->estado) }}</div>
    </div>
    <span class="col-2">{{ preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '(${1}) ${2}-${3}', $telefone) }}</span>
    <div class="col-1">
        <a href="/{{$id}}/atualizar">Atualizar</a>
        <form action="/{{$id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </div>
    <div class="col-5">
        <ul class="list-unstyled">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @foreach ($produtos as $produto)
            <li class="{{ ($produto->quantidade <= 3) ? "border border-danger" : '' }}">
                <img src="/storage/img/{{ $produto->imagem }}" alt="imagem" height="30">
                <span>{{ $produto->nome }}</span>
                <span>{{ $produto->quantidade }}</span>

                <a href="/produto/{{$produto->id}}/atualizar">Atualizar</a>
                <form action="/produto/{{$produto->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
                <form action="/produto/{{$produto->id}}/comprar" method="POST">
                    @csrf
                    <input type="number" name="compra">
                    <button type="submit">Comprar</button>
                </form>
                <form action="/produto/{{$produto->id}}/vender" method="POST">
                    @csrf
                    <input type="number" name="venda">
                    <button type="submit">Vender</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</div>