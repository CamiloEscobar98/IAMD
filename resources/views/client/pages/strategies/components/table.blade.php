<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.client.strategies.table.head.name') }}</th>
                <th>{{ __('pages.client.strategies.table.head.description') }}</th>
                <th>{{ __('pages.client.strategies.table.head.created_at') }}</th>
                <th>{{ __('pages.client.strategies.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
               @include('client.pages.strategies.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {!! $links !!}
</div>
