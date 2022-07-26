<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('admin_pages.creators.external_organizations.table.head.nit') }}</th>
                <th>{{ __('admin_pages.creators.external_organizations.table.head.name') }}</th>
                <th>{{ __('admin_pages.creators.external_organizations.table.head.email') }}</th>
                <th>{{ __('admin_pages.creators.external_organizations.table.head.telephone') }}</th>
                <th>{{ __('admin_pages.creators.external_organizations.table.head.address') }}</th>
                <th>{{ __('admin_pages.creators.external_organizations.table.head.created_at') }}</th>
                <th>{{ __('admin_pages.creators.external_organizations.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->nit }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->telephone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{ route('admin.creators.external_organizations.show', $item->id) }}"
                                class="btn btn-sm btn-secondary">
                                <i class="fas fa-sm fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.creators.external_organizations.destroy', $item->id) }}"
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
                <td colspan="12">{{ __('admin_pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
