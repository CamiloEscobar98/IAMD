@if ($editMode)
    <form action="{{ getClientRoute('client.strategies.update', [$item->id]) }}" method="post">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
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
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                cols="30" rows="10">{{ $item->description }}</textarea>
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
    <form action="{{ route('client.strategies.store', $client->name) }}" method="post">
        @csrf

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
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
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                cols="30" rows="10">{{ old('description') }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-description"></span>
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
