<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.intangible_assets.table.head.administrative_unit') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.research_unit') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.project') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.name') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.status') }}</th>
                <th>{{ __('pages.client.intangible_assets.table.head.created_at') }}</th>
                <th class="text-right" style="width: 5em">#</th>
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

<div class="mt-4">
    {!! $links !!}
</div>
