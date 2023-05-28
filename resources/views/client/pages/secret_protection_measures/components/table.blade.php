<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.secret_protection_measures.table.head.name') }}</th>
                <th style="width: 15em">{{ __('pages.client.secret_protection_measures.table.head.created_at') }}</th>
                @canany(['secret_protection_measures.show', 'secret_protection_measures.destroy'])
                    <th class="text-right" style="width: 5em">#</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.secret_protection_measures.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {!! $links !!}
</div>
