<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th style="width: 15em">{{ __('pages.admin.localizations.states.table.head.country') }}</th>
                <th>{{ __('pages.admin.localizations.states.table.head.name') }}</th>
                <th>{{ __('pages.admin.localizations.states.table.head.cities') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('admin.pages.localization.states.components.row')
            @empty
                <tr class="text-center">
                    <td colspan="12">{{ __('pages.default.empty_table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
