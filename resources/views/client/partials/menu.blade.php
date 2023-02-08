@canany(getMainClientPermissions())
    <li class="nav-header">{{ __('menu.client.title') }}</li>
@endcanany

<!-- Administrative Units -->
@can('administrative_units.index')
    <li class="nav-item">
        <a href="{{ route('client.administrative_units.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('facultades') }}">
            <i class="fas fa-university nav-icon"></i>
            <p>{{ __('menu.client.AdministrativeUnits') }}</p>
        </a>
    </li>
@endcan

<!-- Academic Departments -->
@can('academic_departments.index')
    <li class="nav-item">
        <a href="{{ route('client.academic_departments.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('departamentos-academicos') }}">
            <i class="fas fa-globe nav-icon"></i>
            <p>{{ __('menu.client.AcademicDepartments') }}</p>
        </a>
    </li>
@endcan

<!-- Research Units -->
@can('research_units.index')
    <li class="nav-item">
        <a href="{{ route('client.research_units.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('unidades-investigativas') }}">
            <i class="fas fa-microscope nav-icon"></i>
            <p>{{ __('menu.client.ResearchUnits') }}</p>
        </a>
    </li>
@endcan


<!-- Projects -->
@can('projects.index')
    <li class="nav-item">
        <a href="{{ route('client.projects.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('proyectos') }}">
            <i class="fas fa-chalkboard-teacher nav-icon"></i>
            <p>{{ __('menu.client.Projects') }}</p>
        </a>
    </li>
@endcan

<!-- Intangible Assets -->
@can('intangible_assets.index')
    <li class="nav-item">
        <a href="{{ route('client.intangible_assets.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('activos-intangibles') }}">
            <i class="fas fa-archive nav-icon"></i>
            <p>{{ __('menu.client.IntangibleAssets') }}</p>
        </a>
    </li>
@endcan

<!-- Internal Creators -->
@can('creators.internal.index')
    <li class="nav-item">
        <a href="{{ route('client.creators.internal.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('internos') }}">
            <i class="fas fa-user-friends
        nav-icon"></i>
            <p>{{ __('menu.client.CreatorsInternal') }}</p>
        </a>
    </li>
@endcan
<!-- ./Internal Creators -->

<!-- External Creators -->
@can('creators.external.index')
    <li class="nav-item">
        <a href="{{ route('client.creators.external.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('externos') }}">
            <i class="fas fa-user-tie nav-icon"></i>
            <p>{{ __('menu.client.CreatorsExternal') }}</p>
        </a>
    </li>
@endcan
<!-- ./External Creators -->

<!-- Users -->
@can('users.index')
    <li class="nav-item">
        <a href="{{ route('client.users.index', [$client->name]) }}" class="nav-link {{ routeIsActived('usuarios') }}">
            <i class="fas fa-users nav-icon"></i>
            <p>{{ __('menu.client.users') }}</p>
        </a>
    </li>
@endcan
<!-- ./Users -->

@canany(getConfigClientPermissions())
    <li class="nav-header">{{ __('menu.client.first_subtitle') }}</li>
@endcanany

<!-- Roles -->
@can('roles.index')
    <li class="nav-item">
        <a href="{{ route('client.roles.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('roles-del-sistema') }}">
            <i class="fas fa-user-cog nav-icon"></i>
            <p>{{ __('menu.client.roles') }}</p>
        </a>
    </li>
@endcan
<!-- ./Roles -->

<!-- Strategy Categories -->
@can('strategy_categories.index')
    <li class="nav-item">
        <a href="{{ route('client.strategy_categories.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('categorias-de-las-estrategias-de-gestion') }}">
            <i class="fas fa-star nav-icon"></i>
            <p>{{ __('menu.client.strategy_categories') }}</p>
        </a>
    </li>
@endcan
<!-- ./Strategy Categories -->

<!-- Strategies -->
@can('strategies.index')
    <li class="nav-item">
        <a href="{{ route('client.strategies.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('estrategias-de-gestion') }}">
            <i class="fas fa-toolbox nav-icon"></i>
            <p>{{ __('menu.client.strategies') }}</p>
        </a>
    </li>
@endcan
<!-- ./Strategies -->

<!-- Financing Types -->
@can('financing_types.index')
    <li class="nav-item">
        <a href="{{ route('client.financing_types.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('financiacion-de-proyectos') }}">
            <i class="fas fa-balance-scale-right nav-icon"></i>
            <p>{{ __('menu.client.financing_types') }}</p>
        </a>
    </li>
@endcan
<!-- ./Financing Types -->

<!-- Project Contract Types -->
@can('project_contract_types.index')
    <li class="nav-item">
        <a href="{{ route('client.project_contract_types.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('contratos-para-proyectos') }}">
            <i class="fas fa-hands-helping	 nav-icon"></i>
            <p>{{ __('menu.client.project_contract_types') }}</p>
        </a>
    </li>
@endcan
<!-- ./Project Contract Types -->

<!-- Priority Tools -->
@can('priority_tools.index')
    <li class="nav-item">
        <a href="{{ route('client.priority_tools.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('herramientas-de-priorizacion') }}">
            <i class="fas fa-tools nav-icon"></i>
            <p>{{ __('menu.client.priority_tools') }}</p>
        </a>
    </li>
@endcan
<!-- ./Priority Tools -->

<!-- Secret Protection Measures -->
@can('secret_protection_measures.index')
    <li class="nav-item">
        <a href="{{ route('client.secret_protection_measures.index', [$client->name]) }}"
            class="nav-link {{ routeIsActived('medidas-secretas-de-proteccion') }}">
            <i class="fas fa-user-secret nav-icon"></i>
            <p>{{ __('menu.client.secret_protection_measures') }}</p>
        </a>
    </li>
@endcan
<!-- ./Secret Protection Measures -->

<li class="nav-header">{{ __('menu.client.second_subtitle') }}</li>

<!-- Reports -->
<li class="nav-item">
    <a href="#" class="nav-link {{ routeIsActived('reports') . routeIsActived('reportes') }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
            {{ __('menu.client.Reports') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('client.reports.custom.index', [$client->name]) }}"
                class="nav-link {{ routeIsActived('personalizado') }}">
                <i class="fas fa-clipboard-check nav-icon"></i>
                <p>{{ __('menu.client.GenerateReport') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('client.reports.generated', [$client->name]) }}"
                class="nav-link {{ routeIsActived('reportes-generados') }}">
                <i class="fas fa-folder-open	 nav-icon"></i>
                <p>{{ __('menu.client.MyReports') }}</p>
            </a>
        </li>
    </ul>
</li>
<!-- ./Reports -->
