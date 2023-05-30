<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.financing_types.table.head.name') }}</th>
                <th>{{ __('pages.client.financing_types.table.head.code') }}</th>
                <th style="width: 15em">{{ __('pages.client.financing_types.table.head.created_at') }}</th>
                @if (role_can_permission(['financing_types.show', 'financing_types.destroy']))
                    <th class="text-right" style="width: 5em">#</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.financing_types.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {!! $links !!}
</div>
