<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.administrative_units.table.head.name') }}</th>
                <th>{{ __('pages.client.administrative_units.table.head.description') }}</th>
                <th>{{ __('pages.client.administrative_units.table.head.research_units') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
               @include('client.pages.administrative_units.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {!! $links !!}
</div>
