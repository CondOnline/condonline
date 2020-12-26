@csrf
<div class="form-group">
    <label>Titulo</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Titulo" value="{{ $document->title??old('title') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

@if (!isset($document))
    <div class="form-group">
        <label>Documento</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('document') is-invalid @enderror" name="document" id="document" accept="application/pdf" required>
            <label class="custom-file-label" for="document">Documento</label>

            @error('document')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="form-check">
        <input type="hidden" name="notifyEmail" value="0">
        <input type="checkbox" class="form-check-input @error('notifyEmail') is-invalid @enderror" id="notifyEmail" name="notifyEmail" value="1">
        <label class="form-check-label" for="notifyEmail">Notificar Usuários por email</label>

        @error('notifyEmail')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
@endif
