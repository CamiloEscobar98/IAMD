<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.admin.creators.assignment_contracts.table.head.name') }}</th>
                <th>{{ __('pages.admin.creators.assignment_contracts.table.head.is_internal') }}</th>
                <th style="width: 15em">{{ __('pages.admin.creators.assignment_contracts.table.head.created_at') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('admin.pages.creators.assignment_contracts.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
