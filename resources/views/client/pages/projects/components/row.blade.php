<tr>
    <td><a href="{{ getClientRoute('client.administrative_units.show', [$item->research_unit->administrative_unit->id]) }}"
            class="btn btn-sm btn-outline-secondary">{{ getParamObject($item->research_unit->administrative_unit, 'name') }}</a>
    </td>
    <td><a href="{{ getClientRoute('client.research_units.show', [$item->research_unit->id]) }}"
            class="btn btn-sm btn-outline-secondary">{{ getParamObject($item->research_unit, 'name') }}</a></td>
    <td>{{ getParamObject($item->director, 'name') }}</td>
    <td>{{ $item->name }}</td>
    <td>
        <b>{{ getParamObject($item->project_financing->financing_type, 'name') }}</b>
        <p>{{ getParamObject($item->project_financing, 'contract') }}</p>
        <p>{{ getParamObject($item->project_financing, 'date') }}</p>
    </td>
    <td>
        {{ __('pages.client.projects.table.body.intangible_assets_count', ['intangible_assets' => $item->intangible_assets_count]) }}
    </td>
    <td class="text-right">
        <div class="btn-group">
            <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                <span class="fas fa-cog"></span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ getClientRoute('client.projects.show', [$item->id]) }}" class="dropdown-item">
                    <i class="fas fa-sm fa-eye"></i> Ver
                </a>
                <form action="{{ getClientRoute('client.projects.destroy', [$item->id]) }}"
                    id="form-delete-{{ $item->id }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="dropdown-item" onclick="destroy(event, {{ $item->id }})">
                        <i class="fas fa-sm fa-trash"></i> Borrar
                    </button>
                </form>
            </div>
        </div>
    </td>
</tr>
