<div id="accordion">

    <!-- PHASE 1 -->
    <div class="card">
        <div class="card-header bg-danger bg-danger">
            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                {{ __('pages.client.intangible_assets.phases.one.title') }}
            </a>
        </div>
        <div id="collapseOne" class="collapse show" data-parent="#accordion">
            <div class="card-body">
                <div class="row justify-content-start">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('pages.client.intangible_assets.phases.one.form.level_1') }}</label>
                            <select name="intangible_asset_type_level_1" id="intangible_asset_type_level_1"
                                class="form-control select2bs4" onchange="changeIntangibleAssetLevel1()"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('pages.client.intangible_assets.phases.one.form.level_2') }}</label>
                            <select name="intangible_asset_type_level_2" id="intangible_asset_type_level_2"
                                class="form-control select2bs4" onchange="changeIntangibleAssetLevel2()"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('pages.client.intangible_assets.phases.one.form.level_3') }}</label>
                            <select name="intangible_asset_type_level_3" id="intangible_asset_type_level_3"
                                class="form-control select2bs4"></select>
                        </div>
                    </div>

                </div>
                <button class="btn btn-sm btn-danger">Guardar</button>
            </div>
        </div>
    </div>
    <!-- ./PHASE ! -->

    <!-- PHASE 2 -->
    <div class="card">
        <div class="card-header bg-danger">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                {{ __('pages.client.intangible_assets.phases.two.title') }}
            </a>
        </div>
        <div id="collapseTwo" class="collapse" data-parent="#accordion">
            <div class="card-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat.
            </div>
        </div>
    </div>
    <!-- ./PHASE 2 -->

    <!-- PHASE 3 -->
    <div class="card">
        <div class="card-header bg-danger">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                {{ __('pages.client.intangible_assets.phases.three.title') }}
            </a>
        </div>
        <div id="collapseThree" class="collapse" data-parent="#accordion">
            <div class="card-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat.
            </div>
        </div>
    </div>
    <!-- ./PHASE 3 -->

</div>
