<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.users.table.head.name') }}</th>
                <th>{{ __('pages.client.users.table.head.email') }}</th>
                <th>{{ __('pages.client.users.table.head.role') }}</th>
                <th style="width: 15em">{{ __('pages.client.users.table.head.created_at') }}</th>
                @if (role_can_permission(['users.show', 'users.destroy']))
                    <th class="text-right" style="width: 5em">#</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.users.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
