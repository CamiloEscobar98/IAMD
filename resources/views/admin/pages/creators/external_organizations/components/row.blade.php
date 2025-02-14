<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->nit }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ getParamObject($item, 'telephone', true) }}</td>
    <td>{{ getParamObject($item, 'address', true) }}</td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    <td class="text-right">
        <div class="btn-group">
            <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                <span class="fas fa-cog"></span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('admin.creators.external_organizations.show', $item->id) }}" class="dropdown-item">
                    <i class="fas fa-sm fa-eye"></i> Ver
                </a>
                <form action="{{ route('admin.creators.external_organizations.destroy', $item->id) }}"
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
