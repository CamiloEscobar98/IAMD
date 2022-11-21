<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->description }}</td>
    @canany(['strategy_categories.show', 'strategy_categories.destroy'])
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @can('strategy_categories.show')
                        <a href="{{ getClientRoute('client.strategy_categories.show', [$item->id]) }}" class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endcan
                    @can('strategy_categories.destroy')
                        <form action="{{ getClientRoute('client.strategy_categories.destroy', [$item->id]) }}"
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
