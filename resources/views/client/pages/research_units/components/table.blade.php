<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.client.research_units.table.head.name') }}</th>
                <th>{{ __('pages.client.research_units.table.head.code') }}</th>
                <th>{{ __('pages.client.research_units.table.head.description') }}</th>
                <th>{{ __('pages.client.research_units.table.head.projects') }}</th>
                <th>{{ __('pages.client.research_units.table.head.created_at') }}</th>
                <th>{{ __('pages.client.research_units.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
               @include('client.pages.research_units.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {!! $links !!}
</div>
