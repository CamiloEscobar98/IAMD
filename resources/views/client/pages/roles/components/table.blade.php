<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.roles.table.head.name') }}</th>
                <th>{{ __('pages.client.roles.table.head.permissions') }}</th>
                <th>{{ __('pages.client.roles.table.head.users') }}</th>
                @canany(['roles.show', 'roles.destroy'])
                    <th class="text-right">#</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.roles.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {!! $links !!}
</div>
