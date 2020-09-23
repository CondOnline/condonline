@csrf
<div class="form-group">
    <label>Residência</label>
    @if (isset($order->residence))
        <br>
        <span>{{ $order->residence->address }}</span>
    @else
        <select id="residence" class="form-control select2 @error('residence') is-invalid @enderror" name="residence" required>
            <option disabled selected>Residência</option>
            @foreach($residences as $residence)
                <option value="{{ $residence->id }}">{{ $residence->address }}</option>
            @endforeach
        </select>
    @endif

    @error('residence')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Destinatário</label>
    @if (isset($order->user))
        <br>
        <span>{{ $order->user->name }}</span>
    @else
        <select id="user" class="form-control @error('user') is-invalid @enderror" name="user" required>
            <option value="" disabled selected>Destinatário</option>
            @if(isset($users))
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            @endif
        </select>
    @endif

    @error('user')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Rastreio</label>
    @if (isset($order->tracking))
        <br>
        <span>{{ $order->tracking }}</span>
    @else
        <input type="text" name="tracking" class="form-control @error('tracking') is-invalid @enderror" placeholder="Rastreio" value="{{ old('tracking') }}" required>
    @endif

    @error('tracking')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Transportadora</label>
    <input type="text" name="shipping_company" class="form-control @error('shipping_company') is-invalid @enderror" placeholder="Remetente" value="{{ $order->shipping_company??old('shipping_company') }}" required>

    @error('shipping_company')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Remetente</label>
    <input type="text" name="sender" class="form-control @error('sender') is-invalid @enderror" placeholder="Remetente" value="{{ $order->sender??old('sender') }}" required>

    @error('sender')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Data do recebimento</label>
    <input type="date" name="input_at" class="form-control @error('input_at') is-invalid @enderror" placeholder="Remetente" value="{{ isset($order->input_at)?$order->input_at->format('Y-m-d'):old('input_at') }}" required>

    @error('input_at')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Foto Encomenda</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="image" accept="image/*">
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
            <input type="file" class="custom-file-input @error('image_signature') is-invalid @enderror" name="image_signature" id="image_signature"  accept="image/*">
            <label class="custom-file-label" for="image_signature">Foto Assinatura</label>

            @error('image_signature')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
@endif
