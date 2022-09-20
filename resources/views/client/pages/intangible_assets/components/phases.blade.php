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
                                <select name="intangible_asset_type_level_1" id="intangible_asset_type_level_1"
                                    class="form-control form-control-sm select2bs4"
                                    onchange="changeIntangibleAssetLevel1()">
                                    @foreach ($categories as $categoryItem)
                                        <option value="{{ $categoryItem->id }}"
                                            {{ twoOptionsIsEqual($category->id, $categoryItem->id) }}>
                                            {{ $categoryItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('pages.client.intangible_assets.phases.one.form.level_2') }}</label>
                                <select name="intangible_asset_type_level_2" id="intangible_asset_type_level_2"
                                    class="form-control form-control-sm select2bs4"
                                    onchange="changeIntangibleAssetLevel2()">
                                    @foreach ($subCategories as $subCategoryItem)
                                        <option value="{{ $subCategoryItem->id }}"
                                            {{ twoOptionsIsEqual($subCategory->id, $subCategoryItem->id) }}>
                                            {{ $subCategoryItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('pages.client.intangible_assets.phases.one.form.level_3') }}</label>
                                <select name="intangible_asset_type_level_3" id="intangible_asset_type_level_3"
                                    class="form-control form-control-sm select2bs4">
                                    @foreach ($products as $productItem)
                                        <option value="{{ $productItem->id }}"
                                            {{ twoOptionsIsEqual($product->id, $productItem->id) }}>
                                            {{ $productItem->name }}</option>
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

</div>
