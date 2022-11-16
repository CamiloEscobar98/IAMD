<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.admin.creators.external_organizations.table.head.name') }}</th>
                <th>{{ __('pages.admin.creators.external_organizations.table.head.nit') }}</th>
                <th>{{ __('pages.admin.creators.external_organizations.table.head.email') }}</th>
                <th>{{ __('pages.admin.creators.external_organizations.table.head.telephone') }}</th>
                <th>{{ __('pages.admin.creators.external_organizations.table.head.address') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('admin.pages.creators.external_organizations.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
