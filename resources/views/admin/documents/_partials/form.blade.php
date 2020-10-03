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
@endif
