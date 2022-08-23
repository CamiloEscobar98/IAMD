<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('client_pages.administrative_units.table.head.name') }}</th>
                <th>{{ __('client_pages.administrative_units.table.head.description') }}</th>
                <th>{{ __('client_pages.administrative_units.table.head.research_units') }}</th>
                <th>{{ __('client_pages.administrative_units.table.head.created_at') }}</th>
                <th>{{ __('client_pages.administrative_units.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
               @include('client.pages.administrative_units.components.row')
            @empty
                <td colspan="12">{{ __('admin_pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {!! $links !!}
</div>
