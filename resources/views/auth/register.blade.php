@extends('auth.layout.auth')

@section('content')
    <div class="card-body register-card-body">
        <p class="login-box-msg">Registrar um novo usuário</p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="name" type="text" placeholder="Nome" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="nome" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
            <div class="input-group mb-3">
                <input id="password" type="password" placeholder="Senha" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="senha">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password-confirm" type="password" placeholder="Senha" class="form-control" name="password_confirmation" required autocomplete="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <hr>

        <a href="{{ route('login') }}" class="text-center">Entrar</a>
    </div>
    <!-- /.form-box -->
@endsection
