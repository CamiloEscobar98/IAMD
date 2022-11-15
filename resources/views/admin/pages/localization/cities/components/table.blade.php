<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.admin.localizations.cities.table.head.country') }}</th>
                <th>{{ __('pages.admin.localizations.cities.table.head.state') }}</th>
                <th>{{ __('pages.admin.localizations.cities.table.head.name') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('admin.pages.localization.cities.components.row')
            @empty
                <tr class="text-center">
                    <td colspan="12">{{ __('pages.default.empty_table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
