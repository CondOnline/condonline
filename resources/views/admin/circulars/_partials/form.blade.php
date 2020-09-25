@csrf
<div class="form-group">
    <label>Título</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Titulo" value="{{ $group->title??old('title') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Usuários</label>
    <select class="select2 @error('users') is-invalid @enderror" name="users[]" multiple="multiple" data-placeholder="Selecione os Usuários" style="width: 100%;">
        @foreach($users as $user)
            <option value="{{ $user->id }}" @if((isset($group->users) && ($group->users->contains($user))) || collect(old('user'))->contains($user->id))
            selected
                @endif>{{ $user->name }}</option>
        @endforeach
    </select>
    <a class="small" href="#" onclick="selectAllPermissions();return false;">Selecionar Tudo</a> |
    <a class="small" href="#" onclick="removeAllPermissions();return false;">Limpar</a>

    @error('users')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
