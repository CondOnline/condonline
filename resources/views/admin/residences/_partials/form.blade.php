@csrf
<div class="form-group">
    <label>Rua</label>
    <select class="form-control" name="street">
        <option>Rua</option>
        @foreach($streets as $street)
            <option value="{{ $street->id }}" @if(isset($residence->street) && ($residence->street == $street))
            selected
                @endif>{{ $street->short }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Número</label>
    <input type="text" name="number" class="form-control" placeholder="Número" value="{{ $residence->number??old('number') }}">
</div>
<div class="form-group">
    <label>Quadra</label>
    <input type="text" name="block" class="form-control" placeholder="Quadra" value="{{ $residence->block??old('block') }}">
</div>
<div class="form-group">
    <label>Lote</label>
    <input type="text" name="lot" class="form-control" placeholder="Lote" value="{{ $residence->lot??old('lot') }}">
</div>
<div class="form-group">
    <label>Vagas</label>
    <input type="text" name="parking_spaces" class="form-control" placeholder="Vagas" value="{{ $residence->parking_spaces??old('parking_spaces') }}">
</div>
<div class="form-group">
    <label>Ramal</label>
    <input type="text" name="extension" class="form-control" placeholder="Ramal" value="{{ $residence->extension??old('extension') }}">
</div>
