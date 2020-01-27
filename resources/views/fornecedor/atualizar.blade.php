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

    <title>Criar</title>
</head>
<body>
    <main class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/{{$fornecedor->id}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="nome" value="{{ $fornecedor->nome}}" placeholder="Nome">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="telefone" value="{{ $fornecedor->telefone}}" placeholder="Telefone">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="cep" value="{{ str_pad($fornecedor->getEndereco()->cep, 8, 0, STR_PAD_LEFT)}}" placeholder="cep">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="rua" value="{{ $fornecedor->getEndereco()->rua}}" placeholder="rua">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="numero" value="{{ $fornecedor->getEndereco()->numero}}" placeholder="numero">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="complemento" value="{{ $fornecedor->getEndereco()->complemento}}" placeholder="complemento">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="cidade" value="{{ $fornecedor->getEndereco()->cidade}}" placeholder="cidade">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="estado" value="{{ $fornecedor->getEndereco()->estado}}" placeholder="estado">
            </div>
            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>
</html>