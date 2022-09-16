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
                                    class="form-control select2bs4" onchange="changeIntangibleAssetLevel1()">
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
                                    class="form-control select2bs4" onchange="changeIntangibleAssetLevel2()">
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
                                    class="form-control select2bs4">
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
                            class="form-control select2bs4">
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
        <div class="card-header {{ phaseIsCompletedColor($item->hasPhaseFourCompleted()) }}">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                <span class="{{ phaseIsCompletedIcon($item->hasPhaseFourCompleted()) }} mr-1"></span>
                {{ __('pages.client.intangible_assets.phases.four.title') }}
            </a>
        </div>
        <div id="collapseFive" class="collapse {{ phaseIsCompletedOpen($item->hasPhaseFourCompleted()) }}"
            data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('client.intangible_assets.phases.four', [$client->name, $item->id]) }}"
                    method="post">

                    @csrf

                    @method('PATCH')
                    <div class="form-group">
                        <label>{{ __('inputs.dpi_id') }}</label>
                        {{-- <select name="dpi_id" id="dpi_id" class="form-control select2bs4" multiple>
                            @foreach ($dpis as $dpi)
                                <option value="{{ $dpi->id }}"
                                    {{ intangibleAssetHasDPI($item->dpis, $dpi->id) }}>
                                    {{ $dpi->name }}</option>
                            @endforeach
                        </select> --}}
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
    <!-- PHASE FIVE: INTANGIBLE ASSET CURRENT STATE -->

</div>
