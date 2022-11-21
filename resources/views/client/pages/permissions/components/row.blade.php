<tr>
    <td>{{ $item->permission_module->name }}</td>
    <td>{{ $item->info }}</td>
    @canany(['permissions.show', 'permissions.destroy'])
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ getClientRoute('client.permissions.show', [$item->id]) }}" class="dropdown-item">
                        <i class="fas fa-sm fa-eye"></i> Ver
                    </a>
                    <form action="{{ getClientRoute('client.permissions.destroy', [$item->id]) }}"
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
    @endcanany
</tr>
