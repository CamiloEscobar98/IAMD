<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->information }}</td>
    <td>
        {{ __('pages.client.administrative_units.table.body.research_units_count', ['research_units_count' => $item->research_units_count]) }}
    </td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    @if (role_can_permission(['administrative_units.show', 'administrative_units.destroy']))
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @if (role_can_permission('administrative_units.show'))
                        <a href="{{ getClientRoute('client.administrative_units.show', [$item->id]) }}"
                            class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endif
                    @if (role_can_permission('administrative_units.destroy'))
                        <form action="{{ getClientRoute('client.administrative_units.destroy', [$item->id]) }}"
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
