<div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <label for="name" class="input-group-text">
        <i class="fas fa-key"></i>
      </label>
    </div>

    <input
      class="form-control @error('name') is-invalid rounded-right @enderror"
      id="name"
      name="name"
      value="{{ $show ? $cocktail->name : old('name') }}"
      type="text"
      placeholder="@lang('Naam')"/>

    @error('name')
    <span class="invalid-feedback" role="alert">
			<strong>
        {{ $message }}
      </strong>
		</span>
    @enderror
  </div>
</div>

<div class="form-group mb-0">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="fas fa-file-image"></i>
      </span>
    </div>

    <div class="custom-file" id="imageFileWrapper">
      <input
        class="custom-file-input"
        id="imageFile"
        type="file"
        accept="image/*"
        name="imageFile">

      <label class="custom-file-label" id="imageFileText" for="imageFile">
        @if($show && $cocktail->img !== null)
          {{ $cocktail->img }}
        @else
          @lang('Bestand kiezen')
        @endif
      </label>
    </div>
  </div>
</div>
