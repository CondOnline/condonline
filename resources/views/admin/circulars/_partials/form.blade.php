@csrf
<div class="form-group">
    <label>Título</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Titulo" value="{{ $circular->title??old('title') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label>Texto</label>
    <textarea class="textarea @error('text') is-invalid @enderror" placeholder="Texto" name="text"
              style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $circular->text_mod??old('text') }}</textarea>

    @error('text')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
