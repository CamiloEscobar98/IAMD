<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->code }}</td>
    @canany(['financing_types.show', 'financing_types.destroy'])
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @can('financing_types.show')
                        <a href="{{ getClientRoute('client.financing_types.show', [$item->id]) }}" class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endcan
                    @can('financing_types.destroy')
                        <form action="{{ getClientRoute('client.financing_types.destroy', [$item->id]) }}"
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
