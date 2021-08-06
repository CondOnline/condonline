@extends('auth.layout.auth')

@section('content')
    <div class="card-body login-card-body">
        <h1>Deploy</h1>
        <p class="login-box-msg">Entre para iniciar a sessão</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
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
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span id="show_password" class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="custom-control-label">
                            Lembre-me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <hr>

        <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
    </div>
    <!-- /.login-card-body -->
@endsection

@section('js')
    <script>
        jQuery(document).ready(function($) {
            $('#show_password').click(function(e) {
                e.preventDefault();
                if ( $('#password').attr('type') == 'password' ) {
                    $('#password').attr('type', 'text');
                    $('#show_password').attr('class', 'fas fa-lock-open');
                } else {
                    $('#password').attr('type', 'password');
                    $('#show_password').attr('class', 'fas fa-lock');
                }
            });
        });
    </script>
@endsection
