<h4 class="mb-4 font-weight-bold">{{ __('pages.client.projects.intangible_assets.title') }}</h4>

<div class="table-responsive">
    <table class="table table-sm  table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.client.intangible_assets.table.head.name') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.created_at') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($item->intangible_assets as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ transformTimestampToString($item->created_at) }}</td>
                    <td>{{ transformTimestampToString($item->updated_at) }}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a href="{{ route('client.intangible_assets.show', [$client->name, $item->id]) }}"
                                class="btn btn-sm btn-secondary">
                                <i class="fas fa-sm fa-eye"></i>
                            </a>
                            <form action="{{ route('client.intangible_assets.destroy', [$client->name, $item->id]) }}"
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
                    <td colspan="12">{{ __('pages.default.empty_table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
