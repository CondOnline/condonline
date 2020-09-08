@csrf
<div class="form-group">
    <label>Rua</label>
    <select class="form-control @error('street') is-invalid @enderror" name="street" required>
        <option disabled selected>Rua</option>
        @foreach($streets as $street)
            <option value="{{ $street->id }}" @if((isset($residence->street) && ($residence->street == $street)) || (old('street') == $street->id))
            selected
                @endif>{{ $street->long }}</option>
        @endforeach
    </select>

    @error('street')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Número</label>
    <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" placeholder="Número" value="{{ $residence->number??old('number') }}">

    @error('number')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Quadra</label>
    <input type="text" name="block" class="form-control @error('block') is-invalid @enderror" placeholder="Quadra" value="{{ $residence->block??old('block') }}">

    @error('block')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Lote</label>
    <input type="text" name="lot" class="form-control @error('lot') is-invalid @enderror" placeholder="Lote" value="{{ $residence->lot??old('lot') }}">

    @error('lot')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Vagas</label>
    <input type="text" name="parking_spaces" class="form-control @error('parking_spaces') is-invalid @enderror" placeholder="Vagas" value="{{ $residence->parking_spaces??old('parking_spaces') }}">

    @error('parking_spaces')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Ramal</label>
    <input type="text" name="extension" class="form-control @error('extension') is-invalid @enderror" placeholder="Ramal" value="{{ $residence->extension??old('extension') }}">

    @error('extension')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Usuários</label>
    <select class="select2 @error('users') is-invalid @enderror" name="users[]" multiple="multiple" data-placeholder="Selecione os usuários" style="width: 100%;">
        @foreach($users as $user)
            <option value="{{ $user->id }}" @if((isset($residence->users) && ($residence->users->contains($user))) || collect(old('users'))->contains($user->id))
            selected
                @endif>{{ $user->name }}</option>
        @endforeach
    </select>

    @error('users')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
