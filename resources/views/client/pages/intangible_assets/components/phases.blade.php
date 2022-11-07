<div id="accordion">

    <!-- PHASE ONE: INTANGIBLE ASSET CLASSIFICATION -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseOneCompleted()) }}">
            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseOneCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.one.title') }}
            </a>
        </div>
        <div id="collapseOne" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseOneCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('client.intangible_assets.phases.one', [$client->name, $item->id]) }}"
                    method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row justify-content-start">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('pages.client.intangible_assets.phases.one.form.level_1') }}</label>
                                <select name="intellectual_property_right_category_id"
                                    id="intellectual_property_right_category_id"
                                    class="form-control form-control-sm select2bs4"
                                    onchange="changeIntellectualPropertyRightCategory()">
                                    @foreach ($categories as $categoryItem => $value)
                                        <option value="{{ $categoryItem }}"
                                            {{ twoOptionsIsEqual($category->id, $categoryItem) }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('pages.client.intangible_assets.phases.one.form.level_2') }}</label>
                                <select name="intellectual_property_right_subcategory_id"
                                    id="intellectual_property_right_subcategory_id"
                                    class="form-control form-control-sm select2bs4"
                                    onchange="changeIntellectualPropertyRightSubcategory()">
                                    @foreach ($subCategories as $subCategoryItem => $value)
                                        <option value="{{ $subCategoryItem }}"
                                            {{ twoOptionsIsEqual($subCategory->id, $subCategoryItem) }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('pages.client.intangible_assets.phases.one.form.level_3') }}</label>
                                <select name="intellectual_property_right_product_id"
                                    id="intellectual_property_right_product_id"
                                    class="form-control form-control-sm select2bs4">
                                    @foreach ($products as $productItem => $value)
                                        <option value="{{ $productItem }}"
                                            {{ twoOptionsIsEqual($product->id, $productItem) }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- Button Save -->
                    <div class="form-group mt-3 mb-0">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseOneCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->

                </form>
            </div>
        </div>
    </div>
    <!-- ./PHASE ONE: INTANGIBLE ASSET CLASSIFICATION -->

    <!-- PHASE TWO: INTANGIBLE ASSET DESCRIPTION -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseTwoCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseTwoCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.two.title') }}
            </a>
        </div>
        <div id="collapseTwo" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseTwoCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('client.intangible_assets.phases.two', [$client->name, $item->id]) }}"
                    method="post">

                    @csrf
                    @method('PATCH')

                    <!-- Description -->
                    <div class="input-group mt-3">
                        <textarea class="form-control {{ isInvalidByError($errors, 'description') }}" name="description" id="description"
                            cols="30" rows="3">{{ $item->description }}</textarea>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-info"></span>
                            </div>
                        </div>
                    </div>

                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <!-- ./Description -->

                    <!-- Button Save -->
                    <div class="form-group mt-3 mb-0">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseTwoCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
            </div>
        </div>
    </div>
    <!-- ./PHASE TWO: INTANGIBLE ASSET DESCRIPTION -->

    <!-- PHASE THREE: INTANGIBLE ASSET STATE -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseThreeCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseThreeCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.three.title') }}
            </a>
        </div>
        <div id="collapseThree" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseThreeCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('client.intangible_assets.phases.three', [$client->name, $item->id]) }}"
                    method="post">

                    @csrf

                    @method('PATCH')

                    <div class="form-group">
                        <label>{{ __('inputs.intangible_asset_state_id') }}</label>
                        <select name="intangible_asset_state_id" id="intangible_asset_state_id"
                            class="form-control form-control-sm select2bs4">
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}"
                                    {{ twoOptionsIsEqual($item->intangible_asset_state_id, $state->id) }}>
                                    {{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Button Save -->
                    <div class="form-group mt-3 mb-0">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseThreeCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
            </div>
        </div>
    </div>
    <!-- ./PHASE THREE: INTANGIBLE ASSET STATE -->

    <!-- PHASE FOUR: INTANGIBLE ASSETS RELATIONED WITH DPIS -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseFourCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseFourCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.four.title') }}
            </a>
        </div>
        <div id="collapseFour" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseFourCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('client.intangible_assets.phases.four', [$client->name, $item->id]) }}"
                    method="post">

                    @csrf

                    @method('PATCH')

                    <div class="form-group">
                        <label>{{ __('inputs.dpi_id') }}</label>
                        <select name="dpi_id[]" id="dpi_id" class="form-control select2bs4" multiple>
                            @foreach ($dpis as $dpi)
                                <option value="{{ $dpi->id }}"
                                    {{ intangibleAssetHasDPI($item->dpis, $dpi->id) }}>
                                    {{ $dpi->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Button Save -->
                    <div class="form-group mt-3 mb-0">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseFourCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
            </div>
        </div>
    </div>
    <!-- ./PHASE FOUR: INTANGIBLE ASSETS RELATIONED WITH DPIS -->

    <!-- PHASE FIVE: INTANGIBLE ASSET CURRENT STATE -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseFiveCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseFiveCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.five.title') }}
            </a>
        </div>
        <div id="collapseFive" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseFiveCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">

                <!-- Subphase: Intangible Asset Is Published -->
                <form action="{{ route('client.intangible_assets.phases.five', [$client->name, $item->id]) }}"
                    method="post">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="sub_phase" value="1" readonly>

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.is_published.title') }}</label>
                        <select id="isPublished" name="is_published" class="form-control form-control-sm"
                            onchange="changeIsPublished()">
                            <option value="1" {{ intangibleAssetHasBeenPublished($item) }}>
                                {{ __('inputs.yes') }}</option>
                            <option value="-1" {{ intangibleAssetHasBeenPublished($item, true) }}>
                                {{ __('inputs.no') }}</option>
                        </select>
                    </div>

                    <div id="publishedContainer">
                        <div class="row justify-content-center mb-4">
                            <div class="col-sm-3 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.is_published.form.published_in') }}</label>
                                    <input type="text" name="published_in"
                                        class="form-control form-control-sm {{ isInvalidByError($errors, 'published_in') }}"
                                        value="{{ getParamObject($item->intangible_asset_published, 'published_in') }}">
                                    @error('published_in')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.is_published.form.information_scope') }}</label>
                                    <select name="information_scope" class="form-control form-control-sm">
                                        @foreach ($informationScopes as $scope => $value)
                                            <option value="{{ $value }}"
                                                {{ twoOptionsIsEqualIntoObject($item->intangible_asset_published, 'information_scope', $value) }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('information_scope')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.is_published.form.published_date') }}</label>
                                    <input type="date" name="published_at"
                                        class="form-control form-control-sm {{ isInvalidByError($errors, 'published_at') }}"
                                        value="{{ getParamObject($item->intangible_asset_published, 'published_at') }}">
                                    @error('published_at')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button Save -->
                    <div class="form-group">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseFiveCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
                <!-- ./Subphase: Intangible Asset Is Published -->

                <hr>

                <!-- Subphase: Intangible Asset has Confidenciality Contract -->
                <form action="{{ route('client.intangible_assets.phases.five', [$client->name, $item->id]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="sub_phase" value="2" readonly>

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.title') }}</label>
                        <select id="hasConfidencialityContract" name="has_confidenciality_contract"
                            class="form-control form-control-sm" onchange="changeHasConfidencialityContract()">
                            <option value="1" {{ intangibleAssetHasConfidencialityContract($item) }}>
                                {{ __('inputs.yes') }}</option>
                            <option value="-1" {{ intangibleAssetHasConfidencialityContract($item, true) }}>
                                {{ __('inputs.no') }}</option>
                        </select>
                    </div>

                    <div id="confidencialityContractContainer">
                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.form.organization_confidenciality') }}</label>
                                    <input type="text" name="organization_confidenciality"
                                        class="form-control form-control-sm {{ isInvalidByError($errors, 'organization_confidenciality') }}"
                                        value="{{ getParamObject($item->intangible_asset_confidenciality_contract, 'organization_confidenciality') }}">
                                    @error('organization_confidenciality')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.form.file') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('inputs.upload') }}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"
                                                name="confidenciality_contract_file">
                                            <label class="custom-file-label"
                                                for="inputGroupFile01">Seleccionar</label>
                                        </div>
                                    </div>
                                    @error('confidenciality_contract_file')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        @if ($item->hasFileOfConfidencialityContract())
                            <div class="form-group">
                                <a href="{{ route('client.intangible_assets.downloads.confidenciality_contract', [$client->name, $item->id]) }}"
                                    class="btn btn-xs btn-danger btn-outline text-white">{{ __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.buttons.download') }}</a>
                            </div>
                        @endif
                    </div>

                    <!-- Button Save -->
                    <div class="form-group">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseFiveCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
                <!-- ./Subphase: Intangible Asset has Confidenciality Contract -->

                <hr>

                <!-- Subphase: Intangible Asset has Creators -->
                <form action="{{ route('client.intangible_assets.phases.five', [$client->name, $item->id]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="sub_phase" value="3" readonly>

                    <div class="form-group">
                        <label>{{ __('inputs.creator_id') }}</label>
                        <select name="creator_id[]" id="creator_id" class="form-control select2bs4" multiple>
                            @foreach ($creators as $creator)
                                <option value="{{ $creator->id }}"
                                    {{ intangibleAssetHasCreators($item->creators, $creator->id) }}>
                                    {{ $creator->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Button Save -->
                    <div class="form-group">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseFiveCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
                <!-- ./Subphase: Intangible Asset has Creators -->

                <hr>

                <!-- Subphase: Intangible Asset has Session Rights -->
                <form action="{{ route('client.intangible_assets.phases.five', [$client->name, $item->id]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="sub_phase" value="4" readonly>

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.title') }}</label>
                        <select id="hasSessionRightContract" name="has_session_right"
                            class="form-control form-control-sm" onchange="changeHasSessionRightContract()">
                            <option value="1" {{ intangibleAssetHasSessionRightContract($item) }}>
                                {{ __('inputs.yes') }}</option>
                            <option value="-1" {{ intangibleAssetHasSessionRightContract($item, true) }}>
                                {{ __('inputs.no') }}</option>
                        </select>
                    </div>

                    <div id="sessionRightContractContainer">
                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.form.owner') }}</label>
                                    <input type="text" name="owner"
                                        class="form-control form-control-sm {{ isInvalidByError($errors, 'owner') }}"
                                        value="{{ getParamObject($item->intangible_asset_session_right_contract, 'owner') }}">
                                    @error('owner')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.form.file') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('inputs.upload') }}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"
                                                name="session_right_contract_file">
                                            <label class="custom-file-label"
                                                for="inputGroupFile01">Seleccionar</label>
                                        </div>
                                    </div>
                                    @error('session_right_contract_file')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        @if ($item->hasFileOfSessionRightContract())
                            <div class="form-group">
                                <a href="{{ route('client.intangible_assets.downloads.session_right_contract', [$client->name, $item->id]) }}"
                                    class="btn btn-xs btn-danger btn-outline text-white">{{ __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.buttons.download') }}</a>
                            </div>
                        @endif
                    </div>

                    <!-- Button Save -->
                    <div class="form-group">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseFiveCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
                <!-- ./Subphase: Intangible Asset has Session Rights -->

                <hr>

                <!-- Subphase: Intangible Asset has Contability -->
                <form action="{{ route('client.intangible_assets.phases.five', [$client->name, $item->id]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="sub_phase" value="5" readonly>

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.contability.title') }}</label>
                        <select id="hasContability" name="has_contability" class="form-control form-control-sm"
                            onchange="changeHasContability()">
                            <option value="1" {{ intangibleAssetHasContability($item) }}>
                                {{ __('inputs.yes') }}</option>
                            <option value="-1" {{ intangibleAssetHasContability($item, true) }}>
                                {{ __('inputs.no') }}</option>
                        </select>
                    </div>

                    <div id="commercialContainer">
                        <div class="form-group">
                            <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.contability.form.price') }}</label>
                            <input type="text" name="price"
                                class="form-control form-control-sm {{ isInvalidByError($errors, 'price') }}"
                                value="{{ getParamObject($item->intangible_asset_contability, 'price') }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('pages.client.intangible_assets.phases.five.sub_phases.contability.form.comments') }}</label>
                            <textarea name="comments" class="form-control {{ isInvalidByError($errors, 'comments') }}" rows="3"
                                cols="30">{{ getParamObject($item->intangible_asset_contability, 'comments') }}</textarea>
                            @error('comments')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Button Save -->
                    <div class="form-group">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseFiveCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
                <!-- Subphase: Intangible Asset has Contability -->

            </div>
        </div>
    </div>
    <!-- PHASE FIVE: INTANGIBLE ASSET CURRENT STATE -->

    <!-- PHASE SIX: INTANGIBLE ASSET USER MESSAGES -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseSixCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseSixCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.six.title') }}
            </a>
        </div>
        <div id="collapseSix" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseSixCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">
                @forelse ($item->user_messages as $message)
                    <div class="card">
                        <div class="card-header bg-gradient-info">
                            <span><i class="fas fa-user mr-2"></i>{{ $message->name }}</span>
                            <span class="float-right">{{ $message->pivot->updated_at }}</span>
                            {{-- @if ($message->id == auth()->user()->id)
                                <span><i class="fas fa-user mr-2"></i>{{ $message->name }}</span>
                            @endif --}}
                        </div>
                        <div class="card-body">
                            <p>{{ $message->pivot->message }}</p>
                        </div>
                    </div>
                @empty
                    <p>{{ __('filters.empty') }}</p>
                @endforelse

                <form action="{{ route('client.intangible_assets.phases.six', [$client->name, $item->id]) }}"
                    method="post">

                    @csrf

                    @method('PATCH')

                    <!-- Store a new message -->
                    <input type="hidden" name="type" value="1">

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.six.form.message') }}</label>
                        <textarea name="message" id="message" cols="30" rows="5"
                            class="form-control {{ isInvalidByError($errors, 'message') }}"></textarea>

                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Button Save -->
                    <div class="form-group mt-3 mb-0">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseSixCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
            </div>
        </div>
    </div>
    <!-- ./PHASE SIX: INTANGIBLE ASSET USER MESSAGES -->

    <!-- PHASE SEVEN: INTANGIBLE ASSET HAS PROTECTION ACTION -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseSevenCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseSeven">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseSevenCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.seven.title') }}
            </a>
        </div>
        <div id="collapseSeven" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseSevenCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">

                <!-- Subphase: Intangible Asset has a deposite -->
                <form action="{{ route('client.intangible_assets.phases.seven', [$client->name, $item->id]) }}"
                    method="post">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="sub_phase" value="1" readonly>

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.seven.sub_phases.has_deposite.title') }}</label>
                        <select id="hasDeposite" name="has_protection_action" class="form-control form-control-sm"
                            onchange="changeHasDeposite()">
                            <option value="1" {{ intangibleAssetHasProtectionAction($item) }}>
                                {{ __('inputs.yes') }}</option>
                            <option value="-1" {{ intangibleAssetHasProtectionAction($item, true) }}>
                                {{ __('inputs.no') }}</option>
                        </select>
                    </div>

                    <div id="hasDepositeContainer">
                        <div class="form-group">
                            <label>{{ __('pages.client.intangible_assets.phases.seven.sub_phases.has_deposite.form.deposite_reference') }}</label>
                            <input type="text" name="reference"
                                class="form-control form-control-sm {{ isInvalidByError($errors, 'reference') }}"
                                value="{{ getParamObject($item->intangible_asset_protection_action, 'reference') }}">
                            @error('published_in')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Button Save -->
                    <div class="form-group">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseSevenCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
                <!-- ./Subphase: Intangible Asset has a deposite -->

                <hr>

                <!-- Subphase: Intangible Asset has Secret Protection Measures -->
                <form action="{{ route('client.intangible_assets.phases.seven', [$client->name, $item->id]) }}"
                    method="post">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="sub_phase" value="2" readonly>

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.seven.sub_phases.has_secret_protection.title') }}</label>
                        <select id="hasSecretProtection" name="has_secret_protection"
                            class="form-control form-control-sm" onchange="changeHasSecretProtection()">
                            <option value="1" {{ intangibleAssetHasSecretProtection($item) }}>
                                {{ __('inputs.yes') }}</option>
                            <option value="-1" {{ intangibleAssetHasSecretProtection($item, true) }}>
                                {{ __('inputs.no') }}</option>
                        </select>
                    </div>

                    <div id="hasSecretProtectionContainer">
                        <div class="form-group">
                            <label>{{ __('inputs.secret_protection_measure_id') }}</label>
                            <select name="secret_protection_measure_id[]" id="secret_protection_measure_id"
                                class="form-control select2bs4 {{ isInvalidByError($errors, 'secret_protection_measure_id') }}"
                                multiple>
                                @foreach ($secretProtectionMeasures as $secretProtectionMeasure)
                                    <option value="{{ $secretProtectionMeasure->id }}"
                                        {{ intangibleAssetHasSecretProtectionMeasure($item->secret_protection_measures, $secretProtectionMeasure->id) }}>
                                        {{ $secretProtectionMeasure->name }}</option>
                                @endforeach
                            </select>

                            @error('secret_protection_measure_id')
                                <small class="text-danger"{{ $message }}></small>
                            @enderror
                        </div>
                    </div>

                    <!-- Button Save -->
                    <div class="form-group">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseSevenCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
                <!-- ./Subphase: Intangible Asset has Secret Protection Measures -->
            </div>
        </div>
    </div>
    <!-- ./ PHASE SEVEN: INTANGIBLE ASSET HAS PROTECTION ACTION -->

    <!-- PHASE EIGHT: INTANGIBLE ASSET HAS PRIORITY TOOLS -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseEightCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseEight">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseEightCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.eight.title') }}
            </a>
        </div>
        <div id="collapseEight" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseEightCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">

                <form action="{{ route('client.intangible_assets.phases.eight', [$client->name, $item->id]) }}"
                    method="post">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.eight.sub_phases.has_tool.title') }}</label>
                        <select id="hasPriorityTools" name="has_priority_tools" class="form-control form-control-sm"
                            onchange="changeHasPriorityTools()">
                            <option value="1" {{ intangibleAssetHasDpiPriorityTool($item) }}>
                                {{ __('inputs.yes') }}</option>
                            <option value="-1" {{ intangibleAssetHasDpiPriorityTool($item, true) }}>
                                {{ __('inputs.no') }}</option>
                        </select>
                    </div>

                    <div id="hasPriorityToolsContainer">
                        @foreach ($item->dpis as $dpi)
                            <div class="form-group">
                                <label>{!! __('pages.client.intangible_assets.phases.eight.sub_phases.has_tool.form.tools', [
                                    'name' => $dpi->dpi->upper_name,
                                ]) !!}</label>
                                <select name="tool_id_{{ $dpi->dpi_id }}[]" class="form-control select2bs4"
                                    multiple>
                                    @foreach ($priorityTools as $tool)
                                        <option value="{{ $tool->id }}"
                                            {{ intangibleAssetHasPriorityTool($item, $dpi->dpi_id, $tool->id) }}>
                                            {{ $tool->name }}</option>
                                    @endforeach
                                </select>
                                @error('published_in')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    <!-- Button Save -->
                    <div class="form-group">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseEightCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
            </div>
        </div>
    </div>
    <!-- PHASE EIGHT: INTANGIBLE ASSET HAS PRIORITY TOOLS -->

    <!-- PHASE NINE: INTANGIBLE ASSET IS COMMERCIAL -->
    <div class="card">
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseNineCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseNine">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseNineCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.nine.title') }}
            </a>
        </div>
        <div id="collapseNine" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseNineCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('client.intangible_assets.phases.nine', [$client->name, $item->id]) }}"
                    method="post">

                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>{{ __('pages.client.intangible_assets.phases.nine.sub_phases.is_commercial.title') }}</label>
                        <select id="isCommercial" name="is_commercial" class="form-control form-control-sm"
                            onchange="changeIsCommercial()">
                            <option value="1" {{ intangibleAssetIsCommercial($item) }}>
                                {{ __('inputs.yes') }}</option>
                            <option value="-1" {{ intangibleAssetIsCommercial($item, true) }}>
                                {{ __('inputs.no') }}</option>
                        </select>
                    </div>

                    <div id="isCommercialContainer">
                        <!-- Reason -->
                        <div class="form-group">
                            <label>{{ __('pages.client.intangible_assets.phases.nine.sub_phases.is_commercial.form.reason') }}</label>
                            <div class="input-group">
                                <textarea class="form-control {{ isInvalidByError($errors, 'reason') }}" name="reason" id="reason"
                                    cols="30" rows="3">{{ getParamObject($item->intangible_asset_commercial, 'reason') }}</textarea>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-info"></span>
                                    </div>
                                </div>
                            </div>

                            @error('reason')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- ./Reason -->
                    </div>



                    <!-- Button Save -->
                    <div class="form-group mt-3 mb-0">
                        <button
                            class="btn {{ phaseIsCompletedButton($item->hasPhaseNineCompleted()) }} btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->
                </form>
            </div>
        </div>
    </div>
    <!-- ./PHASE NINE: INTANGIBLE ASSET IS COMMERCIAL -->

</div>
