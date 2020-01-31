<div class="row justify-content-center row-cols-1 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 mx-3 mx-sm-0 my-4">
    @foreach ($fornecedores as $fornecedor)
    <div class="mx-2 col p-0 my-2 gg-btn-outline-light row m-0 p-0">
        <div class="card-body col-12">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h6 class="card-title mb-0">{{$fornecedor->nome}}</h6>
            </div>
            <div class="text-muted text-left">
                <p class="mt-0 mb-3 text-center">
                    <span>{{ preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '(${1}) ${2}-${3}', $fornecedor->telefone) }}</span>
                </p>
            </div>
        </div>
        <div class="text-center col-8 col-sm-12 rounded row justify-content-center align-items-center border-top border-right text-dark bg-white m-0 p-0">
            <div class="col-12 bg-light rounded align-self-lg-stretch d-flex justify-content-center align-items-center border border-top-0 py-2 py-lg-0">
                <div>Endereço</div>
            </div>
            <div class="col-12 text-center py-2">
                <p class="mb-0 d-none d-lg-block">
                    CEP: {{ preg_replace(
                        '/(\d{5})(\d{3})/', '${1}-${2}', 
                        str_pad($fornecedor->getEndereco()->cep, 
                        8, 
                        0, 
                        STR_PAD_LEFT
                    )) }}
                </p>
                <p class="mb-0">
                    {{ ucfirst($fornecedor->getEndereco()->rua) . ", " . 
                       $fornecedor->getEndereco()->numero
                    }}
                </p>
                <p class="mb-0">
                    {{
                       ucfirst($fornecedor->getEndereco()->cidade) . " - " . 
                       strtoupper($fornecedor->getEndereco()->estado) 
                    }}
                </p>
            </div>
        </div>
        <div class="text-center col rounded row justify-content-center align-items-center border-top text-dark bg-white m-0 p-0">
            <div class="col-12 col-lg-6 bg-light rounded align-self-lg-stretch d-flex justify-content-center align-items-center border border-top-0 py-2 py-lg-0">
                <div>Produtos</div>
            </div>
            <div class="col-12 col-lg text-center h1">
                {{$fornecedor->produtos->count()}}
            </div>
        </div>
    </div>
    @endforeach
</div>