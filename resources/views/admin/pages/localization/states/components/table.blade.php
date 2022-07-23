<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('admin_pages.localizations.states.table.head.name') }}</th>
                <th>{{ __('admin_pages.localizations.states.table.head.country') }}</th>
                <th>{{ __('admin_pages.localizations.states.table.head.cities') }}</th>
                <th>{{ __('admin_pages.localizations.states.table.head.created_at') }}</th>
                <th>{{ __('admin_pages.localizations.states.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->country->name }}</td>
                    <td>{{ $item->cities_count }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{ route('admin.localizations.states.show', $item->id) }}"
                                class="btn btn-sm btn-secondary">
                                <i class="fas fa-sm fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.localizations.states.destroy', $item->id) }}"
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
                <tr class="text-center">
                    <td colspan="12">{{ __('admin_pages.default.empty_table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
