<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <main class="container-fluid">
        <div>
            <a href="/criar">Criar Fornecedor</a>
        </div>
        <div>
            <a href="/produto/criar">Criar Produto</a>
        </div>
    @isset($fornecedor)
        @include('fornecedor', [
            'id' => $fornecedor->id,
            'nome' => $fornecedor->nome,
            'endereco' => $fornecedor->getEndereco(),
            'telefone' => $fornecedor->telefone,
            'produtos' => $fornecedor->produtos
        ])
    @endisset
    @isset($fornecedores)
        @foreach ($fornecedores as $fornecedor)
        @include('fornecedor', [
            'id' => $fornecedor->id,
            'nome' => $fornecedor->nome,
            'endereco' => $fornecedor->getEndereco(),
            'telefone' => $fornecedor->telefone,
            'produtos' => $fornecedor->produtos
            ])
        @endforeach
    @endisset
    </main>
</body>
</html>