  <!-- Name -->
  <div class="input-group mt-3">
      <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
          placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
      <div class="input-group-append">
          <div class="input-group-text">
              <span class="fas fa-star"></span>
          </div>
      </div>
  </div>

  @error('name')
      <small class="text-danger">{{ $message }}</small>
  @enderror
  <!-- ./Name -->

  
