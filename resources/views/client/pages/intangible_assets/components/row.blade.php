<tr>
    <td>
        <a href="{{ getClientRoute('client.projects.show', [$item->project->id]) }}"
            class="btn btn-sm btn-outline-secondary">{{ getParamObject($item->project, 'name') }}</a>
    </td>
    <td>
        @forelse ($item->research_units as $research_unit)
            <a href="{{ getClientRoute('client.research_units.show', [$research_unit->id]) }}"
                class="btn btn-sm btn-outline-secondary">{{ getParamObject($research_unit, 'name') }}</a>
        @empty
        @endforelse
    </td>
    <td>{{ $item->name }}</td>
    <td>{{ getParamObject($item->classification, 'name', true) }}</td>
    <td>{{ getParamObject($item->intangible_asset_state, 'name', true) }}</td>
    <td>
        <div class="progress">
            <div class="progress-bar {{ getStatusBarColor($item->progressPhases()) }}" role="progressbar"
                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $item->progressPhases() }}%">
                <span class="">{{ round($item->progressPhases()) }}%</span>
            </div>
        </div>
    </td>
    <td>{{ transformDatetoString($item->date) }}</td>
    @if (role_can_permission(['intangible_assets.show', 'intangible_assets.destroy']))
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @if (role_can_permission('intangible_assets.show'))
                        <a href="{{ getClientRoute('client.intangible_assets.show', [$item->id]) }}"
                            class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endif
                    @if (role_can_permission('intangible_assets.destroy'))
                        <form action="{{ getClientRoute('client.intangible_assets.destroy', [$item->id]) }}"
                            id="form-delete-{{ $item->id }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="dropdown-item" onclick="destroy(event, {{ $item->id }})">
                                <i class="fas fa-sm fa-trash"></i> Borrar
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </td>
    @endif

</tr>
