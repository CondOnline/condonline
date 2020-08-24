@csrf
<div class="form-group">
    <label>Grupo de Acesso</label>
    <select class="form-control @error('userAccessGroup') is-invalid @enderror" name="userAccessGroup">
        <option>Grupo</option>
        @foreach($userAccessGroups as $userAccessGroup)
            <option value="{{ $userAccessGroup->id }}" @if((isset($user->userAccessGroup) && ($user->userAccessGroup == $userAccessGroup)) || (old('userAccessGroup') == $userAccessGroup->id))
                selected
            @endif>{{ $userAccessGroup->title }}</option>
        @endforeach
    </select>

    @error('userAccessGroup')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome" value="{{ $user->name??old('name') }}">

    @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>CPF</label>
    <input type="text" name="cpf" class="form-control @error('cpf') is-invalid @enderror" placeholder="CPF" value="{{ $user->cpf??old('cpf') }}">

    @error('cpf')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>RG</label>
    <input type="text" name="rg" class="form-control @error('rg') is-invalid @enderror" placeholder="RG" value="{{ $user->rg??old('rg') }}">

    @error('rg')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Gênero</label>
    <select class="form-control @error('gender') is-invalid @enderror" name="gender">
        <option>Genero</option>
        <option value="male" @if((isset($user->gender) && ($user->gender == 'male')) || (old('gender') == 'male'))
            selected
        @endif>Masculino</option>
        <option value="female" @if((isset($user->gender) && ($user->gender == 'female')) || (old('gender') == 'female'))
            selected
        @endif>Feminino</option>
    </select>

    @error('gender')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Celular</label>
    <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" placeholder="Celular" value="{{ $user->mobile_phone??old('mobile_phone') }}">

    @error('mobile_phone')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Nascimento</label>
    <input type="date" name="birth" class="form-control @error('birth') is-invalid @enderror" placeholder="Nascimento" value="{{ isset($user->birth)?$user->birth->format('Y-m-d'):old('birth') }}">

    @error('birth')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $user->email??old('email') }}">

    @error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Residências</label>
    <select class="select2 @error('residences') is-invalid @enderror" name="residences[]" multiple="multiple" data-placeholder="Selecione as residências" style="width: 100%;">
        @foreach($residences as $residence)
            <option value="{{ $residence->id }}" @if((isset($user->residences) && ($user->residences->contains($residence))) || (collect(old('residences'))->contains($residence->id)))
            selected
                @endif>{{ $residence->street->short . ' ' . $residence->number }}</option>
        @endforeach
    </select>

    @error('residences')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Foto</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Foto</label>
    </div>
</div>
<div class="form-check my-3">
    <input type="checkbox" class="form-check-input" id="dweller" name="dweller" @if (!isset($user) || $user->dweller)
        checked
    @endif>
    <label class="form-check-label" for="dweller">Morador</label>
</div>

@if (isset($user))
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="blocked" name="blocked" @if ($user->blocked)
        checked
            @endif>
        <label class="form-check-label" for="blocked">Bloqueado</label>
    </div>
@endif
