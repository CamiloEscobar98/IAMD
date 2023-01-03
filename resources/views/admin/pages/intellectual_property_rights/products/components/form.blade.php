   <!-- Intellectual Property Rights Categories -->
   <div class="form-group">
       <label>{{ __('inputs.intellectual_property_rights_category') }}:</label>
       <div class="input-group">
           <select class="form-control select2bs4" name="intellectual_property_right_category_id"
               id="intellectual_property_right_category_id" onchange="changeIntellectualPropertyRightCategory()">
               @foreach ($categories as $categoryItem => $value)
                   <option value="{{ $categoryItem }}" {{ twoOptionsIsEqual($category->id, $categoryItem) }}>
                       {{ $value }}
                   </option>
               @endforeach
           </select>
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-star"></span>
               </div>
           </div>
       </div>

       @error('intellectual_property_right_category_id')
           <small class="text-danger">{{ $message }}</small>
       @enderror
   </div>
   <!-- ./Intellectual Property Rights Categories  -->

   <!-- Intellectual Property Rights Subcategories -->
   <div class="form-group mt-3">
       <label>{{ __('inputs.intellectual_property_rights_subcategory') }}:</label>
       <div class="input-group">
           <select class="form-control select2bs4" name="intellectual_property_right_subcategory_id"
               id="intellectual_property_right_subcategory_id">
               @foreach ($subcategories as $subCategoryItem => $value)
                   <option value="{{ $subCategoryItem }}" {{ twoOptionsIsEqual($subcategory->id, $subCategoryItem) }}>
                       {{ $value }}
                   </option>
               @endforeach
           </select>
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-square"></span>
               </div>
           </div>
       </div>

       @error('intellectual_property_right_subcategory_id')
           <small class="text-danger">{{ $message }}</small>
       @enderror
   </div>
   <!-- ./Intellectual Property Rights Subcategories  -->

   <!-- Name -->
   <div class="form-group mt-3">
       <label>{{ __('inputs.name') }}:</label>
       <div class="input-group">
           <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
               placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-circle"></span>
               </div>
           </div>
       </div>

       @error('name')
           <small class="text-danger">{{ $message }}</small>
       @enderror
   </div>
   <!-- ./Name -->

   <!-- Code -->
   <div class="form-group mt-3">
       <label>{{ __('inputs.code') }}:</label>
       <div class="input-group">
           <input type="text" name="code" class="form-control {{ isInvalidByError($errors, 'code') }}"
               placeholder="{{ __('inputs.code') }}" value="{{ old('code', $item->code) }}">
           <div class="input-group-append">
               <div class="input-group-text">
                   <span class="fas fa-circle"></span>
               </div>
           </div>
       </div>

       @error('code')
           <small class="text-danger">{{ $message }}</small>
       @enderror
   </div>
   <!-- ./Code -->
