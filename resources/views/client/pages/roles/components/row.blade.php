<tr>
    <td>{{ $item->info }}</td>
    <td>
        {{ __('pages.client.roles.table.body.permissions_count', ['count' => $item->permissions_count]) }}
    </td>
    <td>
        {{ __('pages.client.roles.table.body.users_count', ['count' => $item->users_count]) }}
    </td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    @if (role_can_permission(['roles.show', 'roles.destroy']))
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @if (role_can_permission('roles.show'))
                        <a href="{{ getClientRoute('client.roles.show', [$item->id]) }}" class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endif
                    @if (role_can_permission('roles.destroy'))
                        <form action="{{ getClientRoute('client.roles.destroy', [$item->id]) }}"
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
