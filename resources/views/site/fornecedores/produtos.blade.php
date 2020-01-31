<ul class="list-group list-group-flush text-center border">
    <li class="list-group-item p-2 bg-light rounded">
        <strong>Produtos</strong>
    </li>
    @if ($fornecedor->produtos->count() === 0)
    <li class="list-group-item p-2 bg-light rounded">Nenhum produto fornecido</li>
    @endif
    @foreach ($fornecedor->produtos as $produto)
    <li class="list-group-item p-2">
        <div class="row justify-content-start align-items-start m-0 p-0">
            <img src="/storage/img/{{$produto->imagem}}" class="gg-posicao-imagem-contain-fornecedor gg-max-h-1 col-2" alt="Imagem do {{$produto->nome}}">
            <span class="col-8 text-center">
                {{$produto->nome}}
            </span>
        </div>
    </li>
    @isset($fornecedor->produtos[4])
    @if ($fornecedor->produtos[2] == $produto)
    <li class="list-group-item p-2 bg-light rounded">
        <i class="fas fa-ellipsis-h"></i>
    </li>
    <?php break; ?>
    @endif
    @endisset
    @endforeach
</ul>