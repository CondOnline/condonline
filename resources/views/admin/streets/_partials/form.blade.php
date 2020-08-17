@csrf
<div class="form-group">
    <label>Abreviação</label>
    <input type="text" name="short" class="form-control" placeholder="Abreviação" value="{{ $street->short??old('short') }}">
</div>
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="long" class="form-control" placeholder="Nome" value="{{ $street->long??old('long') }}">
</div>
