<tr>
    <td>
        <a href="{{ route('admin.localizations.countries.show', $item->country->id) }}"
            class="btn btn-sm btn-outline-secondary">{{ $item->country->name }}</a>
    </td>
    <td>
        <a href="{{ route('admin.localizations.states.show', $item->state->id) }}"
            class="btn btn-sm btn-outline-secondary">{{ $item->state->name }}</a>
    </td>
    <td>{{ $item->name }}</td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    <td class="text-right">
        <div class="btn-group">
            <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                <span class="fas fa-cog"></span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('admin.localizations.cities.show', $item->id) }}" class="dropdown-item">
                    <i class="fas fa-sm fa-eye"></i> Ver
                </a>
                <form action="{{ route('admin.localizations.cities.destroy', $item->id) }}"
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
