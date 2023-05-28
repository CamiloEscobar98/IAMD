<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.creators.external.table.head.name') }}</th>
                <th>{{ __('pages.client.creators.external.table.head.phone') }}</th>
                <th>{{ __('pages.client.creators.external.table.head.document') }}</th>
                <th>{{ __('pages.client.creators.external.table.head.external_organization') }}</th>
                <th>{{ __('pages.client.creators.external.table.head.assignment_contract') }}</th>
                <th style="width: 15em">{{ __('pages.client.creators.external.table.head.created_at') }}</th>
                @canany(['creators.external.show', 'creators.external.destroy'])
                    <th class="text-right">#</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.creators.external.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
