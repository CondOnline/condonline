@extends('auth.layout.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Recuperar senha</p>

        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Enviar link de Recuperação</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <hr>

        <a href="{{ route('login') }}" class="text-center">Entrar</a>
    </div>
    <!-- /.login-card-body -->
@endsection
