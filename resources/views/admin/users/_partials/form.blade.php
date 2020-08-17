@csrf
<div class="form-group">
    <label>Grupo Usuário</label>
    <select class="form-control" name="userGroup">
        <option>Grupo</option>
        @foreach($userGroups as $userGroup)
            <option value="{{ $userGroup->id }}" @if(isset($user->userGroup) && ($user->userGroup == $userGroup))
                selected
            @endif>{{ $userGroup->title }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $user->name??old('name') }}">
</div>
<div class="form-group">
    <label>CPF</label>
    <input type="text" name="cpf" class="form-control" placeholder="CPF" value="{{ $user->cpf??old('cpf') }}">
</div>
<div class="form-group">
    <label>RG</label>
    <input type="text" name="rg" class="form-control" placeholder="RG" value="{{ $user->rg??old('rg') }}">
</div>
<div class="form-group">
    <label>Gênero</label>
    <select class="form-control" name="gender">
        <option>Genero</option>
        <option value="male" @if(isset($user->gender) && ($user->gender == 'male'))
            selected
        @endif>Masculino</option>
        <option value="female" @if(isset($user->gender) && ($user->gender == 'female'))
            selected
        @endif>Feminino</option>
    </select>
</div>
<div class="form-group">
    <label>Celular</label>
    <input type="text" name="mobile_phone" class="form-control" placeholder="Celular" value="{{ $user->mobile_phone??old('mobile_phone') }}">
</div>
<div class="form-group">
    <label>Nascimento</label>
    <input type="date" name="birth" class="form-control" placeholder="Nascimento" value="{{ $user->birth??old('birth') }}">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email??old('email') }}">
</div>
