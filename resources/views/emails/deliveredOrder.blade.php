@component('mail::message')
<p> Olá {{$order->user->name}}, </p>
<p> sua encomenda com rastreio: {{ $order->tracking }}, acaba de ser entregue em sua residência. </p>

<h2>Dados da encomenda:</h2>
@component('mail::panel')
    <p><b>Rastreios: </b>{{ $order->tracking }}</p>
    <p><b>Residência: </b>{{ $order->residence->address }}</p>
    <p><b>Transportadora: </b>{{ $order->shipping_company }}</p>
    <p><b>Remetente: </b>{{ $order->sender }}</p>
    <p><b>Quem Recebeu: </b>{{ $order->received }}</p>
@endcomponent

@component('mail::button',['url' => route('user.orders.show', $order->id), 'color' => 'green'])
    Ver minha encomenda
@endcomponent

Obrigado, {{ config('app.name') }}
@endcomponent
