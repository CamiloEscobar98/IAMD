<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.localizations.countries.table.head.name') }}</th>
                <th>{{ __('pages.localizations.countries.table.head.states') }}</th>
                <th>{{ __('pages.localizations.countries.table.head.cities') }}</th>
                <th>{{ __('pages.localizations.countries.table.head.created_at') }}</th>
                <th>{{ __('pages.localizations.countries.table.head.updated_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->states_count }}</td>
                    <td>{{ $item->cities_count }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
