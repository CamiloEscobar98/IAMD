<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.roles.table.head.name') }}</th>
                <th>{{ __('pages.client.roles.table.head.permissions') }}</th>
                <th>{{ __('pages.client.roles.table.head.users') }}</th>
                <th style="width: 15em">{{ __('pages.client.roles.table.head.created_at') }}</th>
                @if (role_can_permission(['roles.show', 'roles.destroy']))
                    <th class="text-right">#</th>
                @endif
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
