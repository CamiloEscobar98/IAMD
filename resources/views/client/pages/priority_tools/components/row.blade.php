<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->description_table }}</td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    @if (role_can_permission(['priority_tools.show', 'priority_tools.destroy']))
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @if (role_can_permission('priority_tools.show'))
                        <a href="{{ getClientRoute('client.priority_tools.show', [$item->id]) }}" class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endif
                    @if (role_can_permission('priority_tools.destroy'))
                        <form action="{{ getClientRoute('client.priority_tools.destroy', [$item->id]) }}"
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
