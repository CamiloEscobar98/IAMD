<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.client.academic_departments.table.head.name') }}</th>
                <th>{{ __('pages.client.academic_departments.table.head.research_units') }}</th>
                <th style="width: 15em">{{ __('pages.client.academic_departments.table.head.created_at') }}</th>
                @if (role_can_permission(['academic_departments.show', 'academic_departments.destroy']))
                    <th class="text-right" style="width: 5em">#</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.academic_departments.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
