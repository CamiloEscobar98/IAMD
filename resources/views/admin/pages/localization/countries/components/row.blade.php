<tr>
    <td>{{ $item->name }}</td>
    <td>{{ __('pages.admin.localizations.countries.table.body.states_count', ['count' => $item->states_count]) }}</td>
    <td>{{ __('pages.admin.localizations.countries.table.body.cities_count', ['count' => $item->cities_count]) }}</td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    <td class="text-right">
        <div class="btn-group">
            <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                <span class="fas fa-cog"></span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('admin.localizations.countries.show', $item->id) }}" class="dropdown-item">
                    <i class="fas fa-sm fa-eye"></i> Ver
                </a>
                <form action="{{ route('admin.localizations.countries.destroy', $item->id) }}"
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
