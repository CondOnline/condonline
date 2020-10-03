@component('mail::message')
<p> Olá {{$notifiable->name}}, </p>
<p> Foi adicionado um novo documento ao sistema. </p>

@component('mail::panel')
    <p><b>Documento: </b>{{ $document->title }}</p>
@endcomponent

@component('mail::button',['url' => route('user.documents.index'), 'color' => 'green'])
    Ver documentos
@endcomponent

Obrigado, {{ config('app.name') }}
@endcomponent
