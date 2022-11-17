   <!-- Name -->
   <div class="form-group">
       <label>{{ __('inputs.name') }}:</label>
       <div class="input-group">
           <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
               placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-user"></span>
               </div>
           </div>
       </div>

       @error('name')
           <small class="text-danger">{{ $message }}</small>
       @enderror
   </div>

   <!-- ./Name -->

   <!-- Email -->
   <div class="form-group mt-3">
       <label>{{ __('inputs.email') }}:</label>
       <div class="input-group">
           <input type="email" name="email" class="form-control {{ isInvalidByError($errors, 'email') }}"
               placeholder="{{ __('inputs.email') }}" value="{{ old('email', $item->email) }}">
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-at"></span>
               </div>
           </div>
       </div>

       @error('email')
           <small class="text-danger">{{ $message }}</small>
       @enderror
   </div>
   <!-- ./Email -->

   <!-- Password -->
   <div class="form-group mt-3">
       <label>{{ __('inputs.password') }}:</label>
       <div class="input-group">
           <input type="password" name="password" class="form-control {{ isInvalidByError($errors, 'password') }}"
               placeholder="{{ __('inputs.password') }}" value="{{ old('password') }}">
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-key"></span>
               </div>
           </div>
       </div>

       @error('password')
           <small class="text-danger">{{ $message }}</small>
       @enderror
   </div>
   <!-- ./Password -->

   <!-- Repeat Password -->
   <div class="form-group mt-3">
       <label>{{ __('inputs.repeat_password') }}:</label>
       <div class="input-group">
           <input type="password" name="repeat_password"
               class="form-control {{ isInvalidByError($errors, 'repeat_password') }}"
               placeholder="{{ __('inputs.repeat_password') }}" value="{{ old('repeat_password') }}">
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-user-lock"></span>
               </div>
           </div>
       </div>

       @error('repeat_password')
           <small class="text-danger">{{ $message }}:</small>
       @enderror
   </div>
   <!-- ./Repeat Password -->
