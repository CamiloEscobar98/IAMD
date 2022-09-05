<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.client.creators.internal.table.head.name') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.document') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.linkage_type') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.assignment_contract') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.created_at') }}</th>
                <th>{{ __('pages.client.creators.internal.table.head.updated_at') }}</th>
                <th class="text-right">#</th>
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

<div class="mt-4">
    {!! $links !!}
</div>
