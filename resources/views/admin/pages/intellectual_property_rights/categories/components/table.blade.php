<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.admin.intellectual_property_rights.categories.table.head.name') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.categories.table.head.subcategories') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.categories.table.head.products') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.categories.table.head.created_at') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.categories.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ __('pages.admin.intellectual_property_rights.categories.table.body.intellectual_property_right_subcategories_count', ['count' => $item->intellectual_property_right_subcategories_count]) }}
                    </td>
                    <td>{{ __('pages.admin.intellectual_property_rights.categories.table.body.intellectual_property_right_products_count', ['count' => $item->intellectual_property_right_products_count]) }}
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{ route('admin.intellectual_property_rights.categories.show', $item->id) }}"
                                class="btn btn-sm btn-secondary">
                                <i class="fas fa-sm fa-eye"></i>
                            </a>
                            <form
                                action="{{ route('admin.intellectual_property_rights.categories.destroy', $item->id) }}"
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
