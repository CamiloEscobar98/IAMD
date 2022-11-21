  <!-- Name -->
  <div class="form-group">
    <label>{{ __('inputs.name') }}:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', getParamObject($item->creator, 'name')) }}">
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
<div class="form-group">
    <label>{{ __('inputs.email') }}:</label>
    <div class="input-group">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            placeholder="{{ __('inputs.email') }}" value="{{ old('email', getParamObject($item->creator, 'email')) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>

    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Email -->

<div class="row">
    <div class="col-lg-4">
        <!-- Phone -->
        <div class="form-group">
            <label>{{ __('inputs.phone') }}:</label>
            <div class="input-group">
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    placeholder="{{ __('inputs.phone') }}"
                    value="{{ old('phone', getParamObject($item->creator, 'phone')) }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
            </div>

            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <!-- ./Phone -->
    </div>
    <div class="col-lg-4">
        <!-- Document Type -->
        <div class="form-group">
            <label>{{ __('inputs.document_type_id') }}:</label>
            <div class="input-group">
                <select name="document_type_id"
                    class="form-control select2bs4 @error('document_type_id') is-invalid @enderror">
                    @foreach ($documentTypes as $documentType => $value)
                        <option value="{{ $documentType }}"
                            {{ twoOptionsIsEqual(old('document_type_id', getParamObjectLevelTwo($item->creator, 'document', 'document_type_id')), $documentType) }}>
                            {{ $value }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-address-card"></span>
                    </div>
                </div>
            </div>

            @error('document_type_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <!-- ./Document Type -->
    </div>
    <div class="col-lg-4">
        <!-- Document -->
        <div class="form-group">
            <label>{{ __('inputs.document') }}:</label>
            <div class="input-group">
                <input type="text" name="document" class="form-control @error('document') is-invalid @enderror"
                    placeholder="{{ __('inputs.document') }}"
                    value="{{ old('document', getParamObjectLevelTwo($item->creator, 'document', 'document')) }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-id-card	"></span>
                    </div>
                </div>
            </div>

            @error('document')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <!-- ./Document -->
    </div>
</div>

 <!--Expedition Place -->
 <div class="row">
     <div class="col-lg-4">
         <!-- Countries -->
         <div class="form-group">
             <label>{{ __('inputs.country_id') }}:</label>
             <div class="input-group">
                 <select name="country_id" id="country_id" class="form-control select2bs4" onchange="changeCountry()">
                     @foreach ($countries as $countryItem)
                         <option value="{{ $countryItem->id }}"
                             {{ twoOptionsIsEqual($country->id, $countryItem->id) }}>
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
     </div>
     <div class="col-lg-4">
         <!-- States -->
         <div class="form-group">
             <label>{{ __('inputs.state_id') }}:</label>
             <div class="input-group">
                 <select name="state_id" id="state_id" class="form-control select2bs4" onchange="changeState()">
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
         <!-- ./States -->
     </div>
     <div class="col-lg-4">
         <!-- Cities -->
         <div class="form-group">
             <label>{{ __('inputs.city_id') }}:</label>
             <div class="input-group">
                 <select name="expedition_place_id" id="city_id" class="form-control select2bs4">
                     @foreach ($cities as $cityItem)
                         <option value="{{ $cityItem->id }}"
                             {{ twoOptionsIsEqual(old('expedition_place_id', getParamObjectLevelTwo($item->creator, 'document', 'expedition_place_id')), $cityItem->id) }}>
                             {{ $cityItem->name }}</option>
                     @endforeach
                 </select>
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-city"></span>
                     </div>
                 </div>
             </div>

             @error('expedition_place_id')
                 <small class="text-danger">{{ $message }}</small>
             @enderror
         </div>
         <!-- ./Cities -->
     </div>
 </div>
 <!-- ./Expedition Place -->

 <div class="row">
     <div class="col-lg-6">
         <!-- Linkage Type -->
         <div class="form-group mt-3">
             <label>{{ __('inputs.linkage_type_id') }}:</label>
             <div class="input-group">
                 <select name="linkage_type_id"
                     class="form-control select2bs4 @error('linkage_type_id') is-invalid @enderror">
                     @foreach ($linkageTypes as $linkageType => $value)
                         <option value="{{ $linkageType }}"
                             {{ twoOptionsIsEqual(old('linkage_type_id', getParamObject($item->linkage_type, 'id')), $linkageType) }}>
                             {{ $value }}</option>
                     @endforeach
                 </select>
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-user-friends"></span>
                     </div>
                 </div>
             </div>

             @error('linkage_type_id')
                 <small class="text-danger">{{ $message }}</small>
             @enderror
         </div>
         <!-- ./Linkage Type -->
     </div>
     <div class="col-lg-6">
         <!-- Assignment Contract -->
         <div class="form-group mt-3">
             <label>{{ __('inputs.assignment_contract_id') }}:</label>
             <div class="input-group">
                 <select name="assignment_contract_id"
                     class="form-control select2bs4 @error('assignment_contract_id') is-invalid @enderror">
                     @foreach ($assignmentContracts as $assignmentContract => $value)
                         <option value="{{ $assignmentContract }}"
                             {{ twoOptionsIsEqual(old('assignment_contract_id', getParamObject($item->assignment_contract, 'id')), $assignmentContract) }}>
                             {{ $value }}</option>
                     @endforeach
                 </select>
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-user-tie"></span>
                     </div>
                 </div>
             </div>

             @error('assignment_contract_id')
                 <small class="text-danger">{{ $message }}</small>
             @enderror
         </div>
         <!-- ./Assignment Contract -->
     </div>
 </div>
