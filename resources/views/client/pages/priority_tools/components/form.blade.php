@if ($editMode)
    <form action="{{ getClientRoute('client.priority_tools.update', [$item->id]) }}" method="post">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ $item->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-tool"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <!-- Info -->
        <div class="input-group mt-3">
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                cols="30" rows="4">{{ $item->description }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa"></span>
                </div>
            </div>
        </div>

        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Info -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('client.priority_tools.store', $client->name) }}" method="post">
        @csrf

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-tools"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <!-- Info -->
        <div class="input-group mt-3">
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                cols="30" rows="4">{{ old('description') }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-description"></span>
                </div>
            </div>
        </div>

        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Info -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
