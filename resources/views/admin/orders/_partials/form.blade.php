@csrf
<div class="form-group">
    <label>Residência</label>
    <select id="residence" class="form-control select2 @error('residence') is-invalid @enderror" name="residence">
        <option disabled selected>Residência</option>
        @foreach($residences as $residence)
            <option value="{{ $residence->id }}" @if((isset($order->residence) && ($order->residence->id == $residence->id)))
            selected
                @endif>{{ $residence->street->short . ' ' . $residence->number }}</option>
        @endforeach
    </select>

    @error('residence')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Destinatário</label>
    <select id="user" class="form-control @error('user') is-invalid @enderror" name="user">
        <option value="" disabled selected>Destinatário</option>
        @if(isset($users))
            @foreach($users as $user)
                <option value="{{ $user->id }}" @if((isset($order->user) && ($order->user->id == $user->id)) || (old('user') == $user->id))
                selected
                    @endif>{{ $user->name }}</option>
            @endforeach
        @endif
    </select>

    @error('user')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Rastreio</label>
    <input type="text" name="tracking" class="form-control @error('tracking') is-invalid @enderror" placeholder="Rastreio" value="{{ $order->tracking??old('tracking') }}">

    @error('tracking')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Transportadora</label>
    <input type="text" name="shipping_company" class="form-control @error('shipping_company') is-invalid @enderror" placeholder="Remetente" value="{{ $order->shipping_company??old('shipping_company') }}">

    @error('shipping_company')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Remetente</label>
    <input type="text" name="sender" class="form-control @error('sender') is-invalid @enderror" placeholder="Remetente" value="{{ $order->sender??old('sender') }}">

    @error('sender')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Data do recebimento</label>
    <input type="date" name="input_at" class="form-control @error('input_at') is-invalid @enderror" placeholder="Remetente" value="{{ isset($order->input_at)?$order->input_at->format('Y-m-d'):old('input_at') }}">

    @error('input_at')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Foto Encomenda</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="image">
        <label class="custom-file-label" for="image">Foto Encomenda</label>

        @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

@if (isset($order))
    <div class="form-group">
        <label>Quem recebeu</label>
        <input type="text" name="received" class="form-control @error('received') is-invalid @enderror" placeholder="Quem recebeu" value="{{ $order->received??old('received') }}">

        @error('received')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Data da entrega</label>
        <input type="date" name="delivered_at" class="form-control @error('delivered_at') is-invalid @enderror" placeholder="Remetente" value="{{ isset($order->delivered_at)?$order->delivered_at->format('Y-m-d'):old('delivered_at') }}">

        @error('delivered_at')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Foto Assinatura</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('image_signature') is-invalid @enderror" name="image_signature" id="image_signature">
            <label class="custom-file-label" for="image_signature">Foto Assinatura</label>

            @error('image_signature')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
@endif
