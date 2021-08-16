<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="CondOnline - Sistema para gerenciamento de condomínios">
    <meta name="author" content="Diogo F Medeiros">

    <title>CondOnline - Sistema para condomínios</title>

    <!-- Favicon -->
    @laravelPWA

    <!-- Meta Tags -->
    <meta name="robots" content="noindex" />
    <meta name="Googlebot" content="noindex" />

    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

</head>
<body class="hold-transition login-page @if(isset(auth()->user()->dark_mode) && auth()->user()->dark_mode) dark-mode @endif">
<div class="login-box">
    <div class="login-logo">
        <span>{{ config('app.condominium') }}</span>
    </div>
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center @if(isset(auth()->user()->dark_mode) && auth()->user()->dark_mode) bg-dark @else bg-gray-light @endif">
            <span class="h2"><img class="mr-2" src="{{ asset('assets/img/CondOnlineLogo.png') }}" height="50"><b>CondOnline</b></span>
        </div>

        @yield('content')

    </div>
    <!-- /.card -->
    {{--<div class="card">
        @yield('content')
    </div>--}}
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->

<script src="{{ asset(mix('js/app.js')) }}"></script>

<script>
    $(document).ready(function(){
        $("form").submit(function(event){
            $("button").attr('disabled', 'disabled');
            $("button").text("Aguarde...");
        });
    });
</script>

@yield('js')

</body>
</html>
