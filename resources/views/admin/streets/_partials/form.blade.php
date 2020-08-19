@csrf
<div class="form-group">
    <label>Abreviação</label>
    <input type="text" name="short" class="form-control @error('short') is-invalid @enderror" placeholder="Abreviação" value="{{ $street->short??old('short') }}">

    @error('short')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="long" class="form-control @error('long') is-invalid @enderror" placeholder="Nome" value="{{ $street->long??old('long') }}">

    @error('long')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
