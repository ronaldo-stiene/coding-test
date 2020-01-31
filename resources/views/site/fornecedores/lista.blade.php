@foreach ($fornecedores as $fornecedor)
<a href="{{route('fornecedor', ['id' => $fornecedor->id])}}" class="gg-fornecedor-item col-12 row justify-content-around gg-btn-outline-light border-top shadow-sm border-bottom text-center text-dark text-decoration-none my-2 mx-0 mx-lg-2 p-0">
    <div class="col-10 col-lg row justify-content-center align-items-center m-0 my-2 p-2 p-lg-0 pl-lg-4">
        <h4 class="text-left mb-0 col-auto col-lg-12 p-0">
            {{$fornecedor->nome}}
        </h4>
        <div class="text-muted text-left col col-lg-12 d-none d-md-flex align-items-center d-lg-inline p-lg-0">
            <p class="mb-0">
                <span>{{ preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '(${1}) ${2}-${3}', $fornecedor->telefone) }}</span>
            </p>
        </div>
    </div>
    <div class="col-auto col-lg-2 rounded p-0 bg-white border-left d-none d-lg-block">
        <div class="col-auto bg-light align-self-stretch d-flex justify-content-center">
            <div>Produtos</div>
        </div>
        <div class="col align-self-stretch d-flex align-items-center justify-content-center display-4">
            {{$fornecedor->produtos->count()}}
        </div>
    </div>
</a>
@endforeach