<tr>
    <td>{{ $item->name }}</td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    @canany(['secret_protection_measures.show', 'secret_protection_measures.destroy'])
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @can('secret_protection_measures.show')
                        <a href="{{ getClientRoute('client.secret_protection_measures.show', [$item->id]) }}"
                            class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endcan
                    @can('secret_protection_measures.destroy')
                        <form action="{{ getClientRoute('client.secret_protection_measures.destroy', [$item->id]) }}"
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
