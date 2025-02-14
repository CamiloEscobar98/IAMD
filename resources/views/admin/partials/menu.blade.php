<li class="nav-header">{{ __('menu.admin.Localizations') }}</li>

<!-- Localizations Options -->

<!-- Countries -->
<li class="nav-item">
    <a href="{{ route('admin.localizations.countries.index') }}" class="nav-link {{ routeIsActived('paises') }}">
        <i class="far fa-flag nav-icon"></i>
        <p>{{ __('menu.admin.Countries') }}</p>
    </a>
</li>
<!-- ./Countries -->

<!-- States -->
<li class="nav-item">
    <a href="{{ route('admin.localizations.states.index') }}" class="nav-link {{ routeIsActived('departamentos') }}">
        <i class="fas fa-building nav-icon"></i>
        <p>{{ __('menu.admin.States') }}</p>
    </a>
</li>
<!-- ./States -->

<!-- Cities -->
<li class="nav-item">
    <a href="{{ route('admin.localizations.cities.index') }}" class="nav-link {{ routeIsActived('ciudades') }}">
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
        class="nav-link {{ routeIsActived('tipos-de-documentos') }}">
        <i class="far fa-id-card nav-icon"></i>
        <p>{{ __('menu.admin.DocumentTypes') }}</p>
    </a>
</li>
<!-- ./Document Types -->

<!-- External Organizations -->
<li class="nav-item">
    <a href="{{ route('admin.creators.external_organizations.index') }}"
        class="nav-link {{ routeIsActived('organizaciones-externas') }}">
        <i class="fas fa-industry nav-icon"></i>
        <p>{{ __('menu.admin.ExternalOrganizations') }}</p>
    </a>
</li>
<!-- ./External Organizations -->

<!-- Assignment Contracts -->
<li class="nav-item">
    <a href="{{ route('admin.creators.assignment_contracts.index') }}"
        class="nav-link {{ routeIsActived('tipos-de-contratos') }}">
        <i class="fas fa-user-tie nav-icon"></i>
        <p>{{ __('menu.admin.AssignmentContracts') }}</p>
    </a>
</li>
<!-- ./Assignment Contracts -->

<!-- ./Creator Options -->

<!-- IntangibleAssets Options -->
<li class="nav-header">{{ __('menu.admin.IntangibleAssets') }}</li>

<li class="nav-item">
    <a href="{{ route('admin.intangible_assets.status.index') }}" class="nav-link {{ routeIsActived('estados') }}">
        <i class="fas fa-battery-half nav-icon"></i>
        <p>{{ __('menu.admin.IntangibleAssetStates') }}</p>
    </a>
</li>
<!-- ./IntangibleAssets Options -->

<!-- Intellectual Property Rights -->
<li class="nav-header">{!! __('menu.admin.IntellectualPropertyRights') !!}</li>

<li class="nav-item">
    <a href="{{ route('admin.intellectual_property_rights.categories.index') }}"
        class="nav-link {{ routeIsActived('categorias') }}">
        <i class="fas fa-caret-right nav-icon"></i>
        <p>{{ __('menu.admin.IntellectualPropertyRightsCategories') }}</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.intellectual_property_rights.subcategories.index') }}"
        class="nav-link {{ routeIsActived('subcategorias') }}">
        <i class="fas fa-caret-right nav-icon"></i>
        <p>{{ __('menu.admin.IntellectualPropertyRightsSubcategories') }}</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.intellectual_property_rights.products.index') }}"
        class="nav-link {{ routeIsActived('productos') }}">
        <i class="fas fa-caret-right nav-icon"></i>
        <p>{{ __('menu.admin.IntellectualPropertyRightsProducts') }}</p>
    </a>
</li>
<!-- ./Intellectual Property Rights -->
