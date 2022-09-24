<li class="nav-header">{{ __('menu.admin.title') }}</li>

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
    <a href="{{ route('client.users.index', [$client->name]) }}"
        class="nav-link {{ routeIsActived('users') }}">
        <i class="fas fa-user-friends nav-icon"></i>
        <p>{{ __('menu.client.users') }}</p>
    </a>
</li>
<!-- ./Users -->

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
