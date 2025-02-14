<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ getParamObject($item->roles->first(), 'info') }}</td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    @if (role_can_permission(['users.show', 'users.destroy']))
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @if (role_can_permission('users.show'))
                        <a href="{{ getClientRoute('client.users.show', [$item->id]) }}" class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endif
                    @if (role_can_permission('users.destroy'))
                        <form action="{{ getClientRoute('client.users.destroy', [$item->id]) }}"
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
