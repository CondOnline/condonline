@csrf
<div class="form-group">
    <label>Título</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Titulo" value="{{ $userAccessGroup->title??old('title') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Descrição" value="{{ $userAccessGroup->description??old('description') }}" required>

    @error('description')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
