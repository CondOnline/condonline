@csrf
<div class="form-group">
    <label>Rua</label>
    <select id="residence" class="form-control select2 @error('residence') is-invalid @enderror" name="residence">
        <option disabled selected>Residencia</option>
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
        <option value="">Destinatário</option>
        @if(isset($users))19111993

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
    <label>Remetente</label>
    <input type="text" name="sender" class="form-control @error('sender') is-invalid @enderror" placeholder="Remetente" value="{{ $order->sender??old('sender') }}">

    @error('sender')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Quem recebeu</label>
    <input type="text" name="received" class="form-control @error('received') is-invalid @enderror" placeholder="Quem recebeu" value="{{ $order->received??old('received') }}">

    @error('received')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
