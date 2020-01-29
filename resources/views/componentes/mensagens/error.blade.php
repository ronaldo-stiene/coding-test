@if ($errors->user->any())
    <script>
        function erro() {
            var erro = "Ops! Algo deu errado:";
            @foreach ($errors->user->all() as $mensagem)
            erro = erro + "\n> {{$mensagem}}"
            @endforeach
            alert(erro)
        }
        erro();
    </script>
@endif