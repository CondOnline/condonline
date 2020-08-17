@csrf
<div class="form-group">
    <label>Titulo</label>
    <input type="text" name="title" class="form-control" placeholder="Titulo" value="{{ $userGroup->title??old('title') }}">
</div>
<div class="form-group">
    <label>Descrção</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{ $userGroup->description??old('description') }}">
</div>
