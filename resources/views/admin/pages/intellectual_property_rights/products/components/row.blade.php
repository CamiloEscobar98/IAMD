<tr>
    <td><a href="{{ route('admin.intellectual_property_rights.categories.show', $item->intellectual_property_right_subcategory->intellectual_property_right_category->id) }}"
            class="btn btn-sm btn-danger">{{ $item->intellectual_property_right_subcategory->intellectual_property_right_category->name }}</a>
    </td>
    <td><a href="{{ route('admin.intellectual_property_rights.subcategories.show', $item->intellectual_property_right_subcategory->id) }}"
            class="btn btn-sm btn-danger">{{ $item->intellectual_property_right_subcategory->name }}</a>
    </td>
    <td>{{ $item->name }}</td>
    <td class="text-right">
        <div class="btn-group">
            <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                <span class="fas fa-cog"></span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('admin.intellectual_property_rights.products.show', $item->id) }}" class="dropdown-item">
                    <i class="fas fa-sm fa-eye"></i> Ver
                </a>
                <form action="{{ route('admin.intellectual_property_rights.products.destroy', $item->id) }}"
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
