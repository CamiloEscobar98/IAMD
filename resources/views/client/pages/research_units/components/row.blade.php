<tr>
    <td><a href="{{ getClientRoute('client.administrative_units.show', [$item->administrative_unit->id]) }}"
            class="btn btn-sm btn-outline-secondary">{{ getParamObject($item->administrative_unit, 'name') }}</a></td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->code }}</td>
    <td>{{ getParamObject($item->research_unit_category, 'name') }}</td>
    <td>{{ getParamObject($item->director, 'name') }}</td>
    <td>{{ getParamObject($item->inventory_manager, 'name') }}</td>
    <td>
        {{ __('pages.client.research_units.table.body.projects_count', ['projects' => $item->projects_count]) }}
    </td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    @canany(['research_units.show', 'research_units.destroy'])
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @can('research_units.show')
                        <a href="{{ getClientRoute('client.research_units.show', [$item->id]) }}" class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endcan
                    @can('research_units.destroy')
                        <form action="{{ getClientRoute('client.research_units.destroy', [$item->id]) }}"
                            id="form-delete-{{ $item->id }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="dropdown-item" onclick="destroy(event, {{ $item->id }})">
                                <i class="fas fa-sm fa-trash"></i> Borrar
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </td>
    @endcanany
</tr>
