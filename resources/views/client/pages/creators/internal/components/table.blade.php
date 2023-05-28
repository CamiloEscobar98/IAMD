<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.creators.internal.table.head.name') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.phone') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.document') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.linkage_type') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.assignment_contract') }}</th>
                <th style="width: 15em">{{ __('pages.client.creators.internal.table.head.created_at') }}</th>
                @canany(['creators.internal.show', 'creators.internal.destroy'])
                    <th class="text-right" style="width: 5em">#</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.creators.internal.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
