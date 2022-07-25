@if ($editMode)
    <form action="{{ route('admin.creators.document_types.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/document_types.png') }}" class="img-fluid" alt="">
        </div>

        <!-- Name -->
        <div class="input-group mt-3">
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

        <!-- Slug -->
        <div class="input-group mt-3">
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                placeholder="{{ __('inputs.slug') }}" value="{{ $item->slug }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('slug')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Slug -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('admin.creators.document_types.store') }}" method="post">
        @csrf

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/document_types.png') }}" class="img-fluid" alt="">
        </div>

        <!-- Name -->
        <div class="input-group mt-3">
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

        <!-- Slug -->
        <div class="input-group mt-3">
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                placeholder="{{ __('inputs.slug') }}" value="{{ old('slug') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('slug')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Slug -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
