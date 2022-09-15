@if ($editMode)
    <form action="{{ getClientRoute('client.administrative_units.update', [$item->id]) }}" method="post">
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

        <!-- Info -->
        <div class="input-group mt-3">
            <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info" cols="30"
                rows="10">{{ $item->info }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('info')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Info -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('client.administrative_units.store', $client->name) }}" method="post">
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

        <!-- Info -->
        <div class="input-group mt-3">
            <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info" cols="30"
                rows="10">{{ old('info') }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-info"></span>
                </div>
            </div>
        </div>

        @error('info')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Info -->

        <div class="form-group mt-3 mb-0">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
