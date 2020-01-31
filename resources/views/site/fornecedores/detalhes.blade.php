@foreach ($fornecedores as $fornecedor)
<a href="{{route('fornecedor', ['id' => $fornecedor->id])}}" class="gg-fornecedor-item col-12 row justify-content-around gg-btn-outline-light border-top shadow-sm border-bottom text-center text-dark text-decoration-none my-2 mx-0 mx-lg-2 p-0">
    <div class="col my-2">
        <h4 class="text-left mb-0   ">{{$fornecedor->nome}}</h4>
        <div class="text-muted text-left">
            <p class="mt-0 mb-3">
                <span>{{ preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '(${1}) ${2}-${3}', $fornecedor->telefone) }}</span>
            </p>
            <p class="mb-0 d-none d-lg-block">
                CEP: {{ preg_replace(
                    '/(\d{5})(\d{3})/', '${1}-${2}', 
                    str_pad($fornecedor->getEndereco()->cep, 
                    8, 
                    0, 
                    STR_PAD_LEFT
                )) }}
            </p>
            <p class="mb-0 d-none d-md-block">
                {{ ucfirst($fornecedor->getEndereco()->rua) . ", " . 
                $fornecedor->getEndereco()->numero . " - " . 
                ucfirst($fornecedor->getEndereco()->cidade) . " - " . 
                strtoupper($fornecedor->getEndereco()->estado) 
                }}
            </p>
        </div>
    </div>
    <div class="col-0 col-lg-4 rounded my-0 p-0 d-none d-lg-block">
        @include('site.fornecedores.produtos')
    </div>
    <div class="col-auto col-md-3 col-lg-0 rounded p-0 bg-white border-left d-block d-lg-none">
        <div class="col-auto bg-light align-self-stretch d-flex justify-content-center">
            <div>Produtos</div>
        </div>
        <div class="col align-self-stretch d-flex align-items-center justify-content-center display-4">
            {{$fornecedor->produtos->count()}}
        </div>
    </div>
</a>
@endforeach