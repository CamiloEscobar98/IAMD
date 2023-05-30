<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.strategies.table.head.name') }}</th>
                <th>{{ __('pages.client.strategies.table.head.description') }}</th>
                <th style="width: 15em">{{ __('pages.client.strategies.table.head.created_at') }}</th>
                @if (role_can_permission(['strategies.show', 'strategies.destroy']))
                    <th class="text-right" style="width: 5em">#</th>
                @endif
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
