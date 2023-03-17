   <!-- Countries -->
   <div class="form-group">
       <label>{{ __('inputs.country_id') }}:</label>
       <div class="input-group">
           <select name="country_id" id="country_id" class="form-control select2bs4" onchange="changeCountry()">
               @foreach ($countries as $countryItem)
                   <option value="{{ $countryItem->id }}" {{ twoOptionsIsEqual($country->id, $countryItem->id) }}>
                       {{ $countryItem->name }}</option>
               @endforeach
           </select>
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-flag"></span>
               </div>
           </div>
       </div>
   </div>
   <!-- ./Countries -->

   <!-- States -->
   <div class="form-group">
       <label>{{ __('inputs.state_id') }}:</label>
       <div class="input-group">
           <select name="state_id" id="state_id" class="form-control select2bs4">
               @foreach ($states as $stateItem)
                   <option value="{{ $stateItem->id }}" {{ twoOptionsIsEqual($state->id, $stateItem->id) }}>
                       {{ $stateItem->name }}</option>
               @endforeach
           </select>
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-building"></span>
               </div>
           </div>
       </div>
   </div>

   @error('state_id')
       <small class="text-danger">{!! $message !!}</small>
   @enderror
   <!-- ./State -->

   <!-- Name -->
   <div class="form-group mt-3">
       <label>{{ __('inputs.name') }}:</label>
       <div class="input-group">
           <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
               placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-city"></span>
               </div>
           </div>
       </div>

       @error('name')
           <small class="text-danger">{!! $message !!}</small>
       @enderror
   </div>
   <!-- ./Name -->
