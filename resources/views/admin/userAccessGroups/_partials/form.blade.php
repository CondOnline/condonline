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
<div class="form-group">
    <label>Permissões</label>
    <select class="select2 @error('permissions') is-invalid @enderror" name="permissions[]" multiple="multiple" data-placeholder="Selecione as permissões" style="width: 100%;">
        @foreach($permissions as $permission)
            <option value="{{ $permission->id }}" @if((isset($userAccessGroup->permissions) && ($userAccessGroup->permissions->contains($permission))) || collect(old('permissions'))->contains($permission->id))
            selected
                @endif>{{ $permission->title }}</option>
        @endforeach
    </select>
    <a class="small" href="#" onclick="selectAllPermissions();return false;">Selecionar Tudo</a> |
    <a class="small" href="#" onclick="removeAllPermissions();return false;">Limpar</a>

    @error('permissions')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
