<li class="nav-header">{{ __('menu.admin.title') }}</li>
<!-- Localizations Options -->
<li class="nav-item {{ dropdownIsActived('localizations') }}">
    <a href="#" class="nav-link {{ routeIsActived('localizations') }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            {{ __('menu.admin.Localizations') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.localizations.countries.index') }}"
                class="nav-link {{ routeIsActived('countries') }}">
                <i class="far fa-flag nav-icon"></i>
                <p>{{ __('menu.admin.Countries') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.localizations.states.index') }}"
                class="nav-link {{ routeIsActived('states') }}">
                <i class="fas fa-building nav-icon"></i>
                <p>{{ __('menu.admin.States') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-city nav-icon"></i>
                <p>{{ __('menu.admin.Cities') }}</p>
            </a>
        </li>
    </ul>
</li>
<!-- ./Localizations Options -->

<!-- Creator Options -->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user-friends"></i>
        <p>
            {{ __('menu.admin.Creators') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-id-card nav-icon"></i>
                <p>{{ __('menu.admin.DocumentTypes') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-industry nav-icon"></i>
                <p>{{ __('menu.admin.ExternalOrganizations') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>{{ __('menu.admin.AssignmentContracts') }}</p>
            </a>
        </li>
    </ul>
</li>
<!-- ./Creator Options -->

<!-- IntangibleAssets Options -->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>
            {{ __('menu.admin.IntangibleAssets') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-battery-half nav-icon"></i>
                <p>{{ __('menu.admin.IntangibleAssetStates') }}</p>
            </a>
        </li>
    </ul>
</li>
<!-- ./IntangibleAssets Options -->

<li class="nav-header">{{ __('menu.admin.subtitle_1') }}</li>

<!-- Universities -->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fas fa-school nav-icon"></i>
        <p>UFPS</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fas fa-school nav-icon"></i>
        <p>UFPSO</p>
    </a>
</li>
<!-- Universities -->

<li class="nav-header">{{ __('menu.admin.subtitle_2') }}</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="far fa-id-card nav-icon"></i>
        <p>{{ __('menu.admin.DocumentTypes') }}</p>
    </a>
</li>
