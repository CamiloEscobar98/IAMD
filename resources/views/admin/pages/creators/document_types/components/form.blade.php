  <!-- Name -->
  <div class="form-group mt-3">
      <label>{{ __('inputs.name') }}:</label>
      <div class="input-group">
          <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
              placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="far fa-id-card"></span>
              </div>
          </div>
      </div>

      @error('name')
          <small class="text-danger">{{ $message }}</small>
      @enderror
  </div>

  <!-- ./Name -->

  <!-- Slug -->
  <div class="form-group mt-3">
      <label>{{ __('inputs.slug') }}:</label>
      <div class="input-group">
          <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
              placeholder="{{ __('inputs.slug') }}" value="{{ old('slug', $item->slug) }}">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-id-card"></span>
              </div>
          </div>
      </div>

      @error('slug')
          <small class="text-danger">{{ $message }}</small>
      @enderror
  </div>

  <!-- ./Slug -->
