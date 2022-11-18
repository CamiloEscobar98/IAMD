 <!-- Modules -->
 <div class="form-group">
     <label>{{ __('inputs.permission_module_id') }}:</label>
     <div class="input-group">
         <select name="permission_module_id"
             class="form-control select2bs4 @error('permission_module_id') is-invalid @enderror">
             @foreach ($modules as $module => $value)
                 <option value="{{ $module }}"
                     {{ twoOptionsIsEqual(old('permission_module_id', getParamObject($item->permission_module, 'id')), $module) }}>
                     {{ $value }}</option>
             @endforeach
         </select>
         <div class="input-group-append">
             <div class="input-group-text">
                 <span class="fas fa-box"></span>
             </div>
         </div>
     </div>

     @error('permission_module_id')
         <small class="text-danger">{{ $message }}</small>
     @enderror
 </div>
 <!-- ./Modules -->
 <!-- Name -->
 <div class="form-group">
     <label>{{ __('inputs.slug') }}:</label>
     <div class="input-group">
         <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
             placeholder="{{ __('inputs.slug') }}" value="{{ old('name', $item->name) }}">
         <div class="input-group-append">
             <div class="input-group-text">
                 <i class="fas fa-user-cog"></i>
             </div>
         </div>
     </div>
 </div>

 @error('name')
     <small class="text-danger">{{ $message }}</small>
 @enderror
 <!-- ./Name -->

 <!-- Info -->
 <div class="form-group mt-3">
     <label>{{ __('inputs.name') }}:</label>
     <div class="input-group">
         <input type="text" name="info" class="form-control {{ isInvalidByError($errors, 'info') }}"
             placeholder="{{ __('inputs.info') }}" value="{{ old('info', $item->info) }}">
         <div class="input-group-append">
             <div class="input-group-text">
                 <i class="fas fa-info"></i>
             </div>
         </div>
     </div>

 </div>
 @error('info')
     <small class="text-danger">{{ $message }}</small>
 @enderror
