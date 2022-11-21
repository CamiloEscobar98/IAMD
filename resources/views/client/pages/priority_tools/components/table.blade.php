<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.priority_tools.table.head.name') }}</th>
                <th>{{ __('pages.client.priority_tools.table.head.description') }}</th>
                @canany(['priority_tools.show', 'priority_tools.destroy'])
                    <th class="text-right" style="width: 5em">#</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.priority_tools.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {!! $links !!}
</div>
