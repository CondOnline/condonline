@component('mail::message')
<p> Olá {{$user->name}}, </p>
<p> Você acaba de ser cadastrado(a) no sistema {{ config('app.name') }}. </p>
<p> Segue credenciais para acessar o sistema:</p>
@component('mail::panel')
    <p><b>Email: </b>{{ $user->email }}</p>
    <p><b>Senha: </b>{{ $password }}</p>
@endcomponent
@component('mail::button',['url' => config('app.url'), 'color' => 'green'])
    Acessar o sistema
@endcomponent
]
<small><b>*</b>Recomendamos a troca da senha logo no primeiro acesso ao sistema!</small>

Obrigado, {{ config('app.name') }} - Demo
@endcomponent
