@csrf
<div class="form-group">
    <label>Titulo</label>
    <input type="text" name="title" class="form-control" placeholder="Titulo" value="{{ $userAccessGroup->title??old('title') }}">
</div>
<div class="form-group">
    <label>Descrção</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{ $userAccessGroup->description??old('description') }}">
</div>
