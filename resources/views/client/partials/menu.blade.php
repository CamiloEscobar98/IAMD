<li class="nav-header">{{ __('menu.client.title') }}</li>

<!-- Administrative Units -->
<li class="nav-item">
    <a href="{{ route('client.administrative_units.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('administrative_units') }}">
        <i class="fas fa-university nav-icon"></i>
        <p>{{ __('menu.client.AdministrativeUnits') }}</p>
    </a>
</li>

<!-- Research Units -->
<li class="nav-item">
    <a href="{{ route('client.research_units.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('research_units') }}">
        <i class="fas fa-microscope nav-icon"></i>
        <p>{{ __('menu.client.ResearchUnits') }}</p>
    </a>
</li>


<!-- Projects -->
<li class="nav-item">
    <a href="{{ route('client.projects.index', [$client->name]) }}" class="nav-link {{ routeIsActived('projects') }}">
        <i class="fas fa-chalkboard-teacher nav-icon"></i>
        <p>{{ __('menu.client.Projects') }}</p>
    </a>
</li>

<!-- Intangible Assets -->
<li class="nav-item">
    <a href="{{ route('client.intangible_assets.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('intangible_assets') }}">
        <i class="fas fa-archive nav-icon"></i>
        <p>{{ __('menu.client.IntangibleAssets') }}</p>
    </a>
</li>

<!-- Creators Options -->
<li class="nav-item">
    <a href="#" class="nav-link {{ routeIsActived('internal') . routeIsActived('external') }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
            {{ __('menu.client.Creators') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('client.creators.internal.index', [$client->name]) }}"
                class="nav-link {{ routeIsActived('internal') }}">
                <i class="fas fa-user-friends
                nav-icon"></i>
                <p>{{ __('menu.client.CreatorsInternal') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('client.creators.external.index', [$client->name]) }}"
                class="nav-link {{ routeIsActived('external') }}">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>{{ __('menu.client.CreatorsExternal') }}</p>
            </a>
        </li>
    </ul>
</li>
<!-- ./Creators Options -->

<!-- Users -->
<li class="nav-item">
    <a href="{{ route('client.users.index', [$client->name]) }}" class="nav-link {{ routeIsActived('users') }}">
        <i class="fas fa-user-friends nav-icon"></i>
        <p>{{ __('menu.client.users') }}</p>
    </a>
</li>
<!-- ./Users -->

<li class="nav-header">{{ __('menu.client.first_subtitle') }}</li>

<!-- Strategies -->
<li class="nav-item">
    <a href="{{ route('client.strategies.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('strategies') }}">
        <i class="fas fa-toolbox nav-icon"></i>
        <p>{{ __('menu.client.strategies') }}</p>
    </a>
</li>
<!-- ./Strategies -->

<!-- Strategy Categories -->
<li class="nav-item">
    <a href="{{ route('client.strategy_categories.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('strategy_categories') }}">
        <i class="fas fa-star nav-icon"></i>
        <p>{{ __('menu.client.strategy_categories') }}</p>
    </a>
</li>
<!-- ./Strategy Categories -->

<!-- Financing Types -->
<li class="nav-item">
    <a href="{{ route('client.financing_types.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('financing_types') }}">
        <i class="fas fa-balance-scale-right nav-icon"></i>
        <p>{{ __('menu.client.financing_types') }}</p>
    </a>
</li>
<!-- ./Financing Types -->

<!-- Priority Tools -->
<li class="nav-item">
    <a href="{{ route('client.priority_tools.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('priority_tools') }}">
        <i class="fas fa-tools nav-icon"></i>
        <p>{{ __('menu.client.priority_tools') }}</p>
    </a>
</li>
<!-- ./Priority Tools -->

<!-- Secret Protection Measures -->
<li class="nav-item">
    <a href="{{ route('client.secret_protection_measures.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('secret_protection_measures') }}">
        <i class="fas fa-user-secret nav-icon"></i>
        <p>{{ __('menu.client.secret_protection_measures') }}</p>
    </a>
</li>
<!-- ./Secret Protection Measures -->

<li class="nav-header">{{ __('menu.client.second_subtitle') }}</li>

<!-- Reports -->
<li class="nav-item">
    <a href="#" class="nav-link {{ routeIsActived('reports') . routeIsActived('reports') }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
            {{ __('menu.client.Reports') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('client.creators.internal.index', [$client->name]) }}"
                class="nav-link {{ routeIsActived('internal') }}">
                <i class="fas fa-clipboard-check nav-icon"></i>
                <p>{{ __('menu.client.GenerateReport') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('client.creators.external.index', [$client->name]) }}"
                class="nav-link {{ routeIsActived('external') }}">
                <i class="fas fa-folder-open	 nav-icon"></i>
                <p>{{ __('menu.client.MyReports') }}</p>
            </a>
        </li>
    </ul>
</li>
<!-- ./Reports -->
