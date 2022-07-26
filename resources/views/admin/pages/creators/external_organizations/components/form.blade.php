@if ($editMode)
    <form action="{{ route('admin.creators.external_organizations.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/company.png') }}" class="img-fluid" alt="">
        </div>

        <!-- Nit -->
        <div class="input-group mt-3">
            <input type="text" name="nit" class="form-control @error('nit') is-invalid @enderror"
                placeholder="{{ __('inputs.nit') }}" value="{{ $item->nit }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('nit')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Nit -->

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

        <!-- Email -->
        <div class="input-group mt-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('inputs.email') }}" value="{{ $item->email }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Email -->

        <!-- Telephone -->
        <div class="input-group mt-3">
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                placeholder="{{ __('inputs.telephone') }}" value="{{ $item->telephone }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('telephone')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Telephone -->

        <!-- Address -->
        <div class="input-group mt-3">
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                placeholder="{{ __('inputs.address') }}" value="{{ $item->address }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Address -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('admin.creators.external_organizations.store') }}" method="post">
        @csrf

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/company.png') }}" class="img-fluid" alt="">
        </div>

        <!-- Nit -->
        <div class="input-group mt-3">
            <input type="text" name="nit" class="form-control @error('nit') is-invalid @enderror"
                placeholder="{{ __('inputs.nit') }}" value="{{ old('nit') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('nit')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Nit -->

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

        <!-- Email -->
        <div class="input-group mt-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('inputs.email') }}" value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Email -->

        <!-- Telephone -->
        <div class="input-group mt-3">
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                placeholder="{{ __('inputs.telephone') }}" value="{{ old('telephone') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('telephone')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Telephone -->

        <!-- Address -->
        <div class="input-group mt-3">
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                placeholder="{{ __('inputs.address') }}" value="{{ old('address') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Address -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
