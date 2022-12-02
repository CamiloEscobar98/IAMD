<tr>
    <td><a href="{{ route('admin.intellectual_property_rights.categories.show', $item->intellectual_property_right_category->id) }}"
            class="btn btn-sm btn-outline-secondary">{{ $item->intellectual_property_right_category->name }}</a></td>
    <td>{{ $item->name }}</td>
    <td>{!! __(
        'pages.admin.intellectual_property_rights.subcategories.table.body.intellectual_property_right_products_count',
        ['count' => $item->intellectual_property_right_products_count],
    ) !!}
    </td>
    <td class="text-right">
        <div class="btn-group">
            <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                <span class="fas fa-cog"></span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('admin.intellectual_property_rights.subcategories.show', $item->id) }}"
                    class="dropdown-item">
                    <i class="fas fa-sm fa-eye"></i> Ver
                </a>
                <form action="{{ route('admin.intellectual_property_rights.subcategories.destroy', $item->id) }}"
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
