<li class="nav-header">{{ __('menu.admin.title') }}</li>

<!-- Administrative Units -->
<li class="nav-item">
    <a href="" class="nav-link">
        <i class="fas fa-university nav-icon"></i>
        <p>{{ __('menu.client.AdministrativeUnits') }}</p>
    </a>
</li>

<!-- Research Units -->
<li class="nav-item">
    <a href="" class="nav-link">
        <i class="fas fa-microscope nav-icon"></i>
        <p>{{ __('menu.client.ResearchUnits') }}</p>
    </a>
</li>

<!-- Projects -->
<li class="nav-item">
    <a href="" class="nav-link">
        <i class="fas fa-chalkboard-teacher nav-icon"></i>
        <p>{{ __('menu.client.Projects') }}</p>
    </a>
</li>

<!-- Intangible Assets -->
<li class="nav-item">
    <a href="" class="nav-link">
        <i class="fas fa-archive nav-icon"></i>
        <p>{{ __('menu.client.IntangibleAssets') }}</p>
    </a>
</li>

<!-- Creators Options -->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            {{ __('menu.client.Creators') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fas fa-user-friends nav-icon"></i>
                <p>{{ __('menu.client.CreatorsInternal') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>{{ __('menu.client.CreatorsExternal') }}</p>
            </a>
        </li>
    </ul>
</li>
<!-- ./Creators Options -->