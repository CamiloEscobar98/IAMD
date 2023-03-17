<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.intangible_assets.table.head.project') }}</th>
                <th style="width: 25em">{{ __('pages.client.intangible_assets.table.head.research_units') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.name') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.classification') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.state') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.status') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.created_at') }}</th>
                @canany(['intangible_assets.show', 'intangible_assets.destroy'])
                    <th class="text-right" style="width: 5em">#</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.intangible_assets.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
