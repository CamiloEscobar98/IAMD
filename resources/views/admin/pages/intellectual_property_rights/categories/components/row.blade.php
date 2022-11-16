<tr>
    <td>{{ $item->name }}</td>
    <td>{!! __(
        'pages.admin.intellectual_property_rights.categories.table.body.intellectual_property_right_subcategories_count',
        ['count' => $item->intellectual_property_right_subcategories_count],
    ) !!}
    </td>
    <td>{!! __(
        'pages.admin.intellectual_property_rights.categories.table.body.intellectual_property_right_products_count',
        ['count' => $item->intellectual_property_right_products_count],
    ) !!}
    </td>
    <td class="text-right">
        <div class="btn-group">
            <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                <span class="fas fa-cog"></span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('admin.intellectual_property_rights.categories.show', $item->id) }}"
                    class="dropdown-item">
                    <i class="fas fa-sm fa-eye"></i> Ver
                </a>
                <form action="{{ route('admin.intellectual_property_rights.categories.destroy', $item->id) }}"
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
