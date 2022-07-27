@if ($editMode)
    <form action="{{ route('admin.intangible_assets.states.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/states.png') }}" class="img-fluid" width="350em">
        </div>

        <!-- Name -->
        <div class="input-group">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="{{ __('inputs.name') }}" value="{{ $item->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <!-- Description -->
        <div class="input-group mt-3">
            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                placeholder="{{ __('inputs.description') }}">{{ $item->description }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Description -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('admin.intangible_assets.states.store') }}" method="post">
        @csrf

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/states.png') }}" class="img-fluid" alt="">
        </div>

        <!-- Name -->
        <div class="input-group">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="{{ __('inputs.name') }}" value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <!-- Description -->
        <div class="input-group mt-3">
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                placeholder="{{ __('inputs.description') }}" value="{{ old('description') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Description -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
