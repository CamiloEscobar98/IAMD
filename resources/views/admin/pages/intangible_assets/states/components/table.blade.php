<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.admin.intangible_assets.states.table.head.name') }}</th>
                <th>{{ __('pages.admin.intangible_assets.states.table.head.description') }}</th>
                <th>{{ __('pages.admin.intangible_assets.states.table.head.created_at') }}</th>
                <th>{{ __('pages.admin.intangible_assets.states.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{ route('admin.intangible_assets.states.show', $item->id) }}"
                                class="btn btn-sm btn-secondary">
                                <i class="fas fa-sm fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.intangible_assets.states.destroy', $item->id) }}"
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
