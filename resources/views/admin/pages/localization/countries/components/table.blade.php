<div class="table-responsive">
    <table class="table table-sm table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.admin.localizations.countries.table.head.name') }}</th>
                <th>{{ __('pages.admin.localizations.countries.table.head.states') }}</th>
                <th>{{ __('pages.admin.localizations.countries.table.head.cities') }}</th>
                <th style="width: 15em">{{ __('pages.admin.localizations.countries.table.head.created_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('admin.pages.localization.countries.components.row')
            @empty
                <tr>
                    <td colspan="12">{{ __('pages.default.empty_table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
