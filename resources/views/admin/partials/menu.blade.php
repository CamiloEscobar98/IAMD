<li class="nav-header">{{ __('menu.admin.Localizations') }}</li>

<!-- Localizations Options -->

<!-- Countries -->
<li class="nav-item">
    <a href="{{ route('admin.localizations.countries.index') }}" class="nav-link {{ routeIsActived('countries') }}">
        <i class="far fa-flag nav-icon"></i>
        <p>{{ __('menu.admin.Countries') }}</p>
    </a>
</li>
<!-- ./Countries -->

<!-- States -->
<li class="nav-item">
    <a href="{{ route('admin.localizations.states.index') }}" class="nav-link {{ routeIsActived('states') }}">
        <i class="fas fa-building nav-icon"></i>
        <p>{{ __('menu.admin.States') }}</p>
    </a>
</li>
<!-- ./States -->

<!-- Cities -->
<li class="nav-item">
    <a href="{{ route('admin.localizations.cities.index') }}" class="nav-link {{ routeIsActived('cities') }}">
        <i class="fas fa-city nav-icon"></i>
        <p>{{ __('menu.admin.Cities') }}</p>
    </a>
</li>
<!-- ./Cities -->

<!-- ./Localizations Options -->

<!-- Creator Options -->
<li class="nav-header">{{ __('menu.admin.Creators') }}</li>

<!-- Document Types -->
<li class="nav-item">
    <a href="{{ route('admin.creators.document_types.index') }}"
        class="nav-link {{ routeIsActived('document_types') }}">
        <i class="far fa-id-card nav-icon"></i>
        <p>{{ __('menu.admin.DocumentTypes') }}</p>
    </a>
</li>
<!-- ./Document Types -->

<!-- External Organizations -->
<li class="nav-item">
    <a href="{{ route('admin.creators.external_organizations.index') }}"
        class="nav-link {{ routeIsActived('external_organizations') }}">
        <i class="fas fa-industry nav-icon"></i>
        <p>{{ __('menu.admin.ExternalOrganizations') }}</p>
    </a>
</li>
<!-- ./External Organizations -->

<!-- Assignment Contracts -->
<li class="nav-item">
    <a href="{{ route('admin.creators.assignment_contracts.index') }}"
        class="nav-link {{ routeIsActived('assignment_contracts') }}">
        <i class="fas fa-book nav-icon"></i>
        <p>{{ __('menu.admin.AssignmentContracts') }}</p>
    </a>
</li>
<!-- ./Assignment Contracts -->

<!-- ./Creator Options -->

<!-- IntangibleAssets Options -->
<li class="nav-header">{{ __('menu.admin.IntangibleAssets') }}</li>

<li class="nav-item">
    <a href="{{ route('admin.intangible_assets.states.index') }}"
        class="nav-link {{ routeIsActived('states') }}">
        <i class="fas fa-battery-half nav-icon"></i>
        <p>{{ __('menu.admin.IntangibleAssetStates') }}</p>
    </a>
</li>
<!-- ./IntangibleAssets Options -->
