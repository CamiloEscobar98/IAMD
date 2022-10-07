<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.category') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.subcategory') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.name') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.created_at') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->intellectual_property_right_subcategory->intellectual_property_right_category->name }}
                    </td>
                    <td>{{ $item->intellectual_property_right_subcategory->name }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{ route('admin.intellectual_property_rights.products.show', $item->id) }}"
                                class="btn btn-sm btn-secondary">
                                <i class="fas fa-sm fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.intellectual_property_rights.products.destroy', $item->id) }}"
                                id="form-delete-{{ $item->id }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="destroy(event, {{ $item->id }})">
                                    <i class="fas fa-sm fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
