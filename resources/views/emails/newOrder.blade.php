@component('mail::message')
<p> Olá , </p>
<p> sua encomenda com rastreio: , acaba de ser recebida. </p>
<p> Logo iremos entrega-la em sua residência.</p>

@component('mail::button',['url' => config('app.url'), 'color' => 'green'])
    Ver minhas encomendas
@endcomponent

Obrigado, {{ config('app.name') }} - Demo
@endcomponent
