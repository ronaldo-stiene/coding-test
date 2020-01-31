@extends('index')
@section('titulo', 'Login | General Goods')

@section('conteudo')
<main>
    <section class="container-md">
        <div class="row justify-content-center m-0 p-0 my-5">
            <div class="col-12 col-sm-8 col-lg-5 col-xl-4 border rounded shadow-sm p-3 gg-bg-light">
                <div class="row justify-content-center m-0 p-0 mb-3">
                    <h3>Login</h3>
                </div>
                @include('componentes.alertas.error')
                <form class="col-12" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="E-Mail" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Senha" minlength="4" maxlength="50" required>
                    </div>
                    <div class="row justify-content-center m-0 p-0">
                        <button type="submit" class="btn btn-dark">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@section('css')
@endsection

@section('scripts')
@endsection
