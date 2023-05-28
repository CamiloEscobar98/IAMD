<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.admin.intellectual_property_rights.categories.table.head.name') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.categories.table.head.subcategories') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.categories.table.head.products') }}</th>
                <th style="width: 15em">{{ __('pages.admin.intellectual_property_rights.categories.table.head.created_at') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
               @include('admin.pages.intellectual_property_rights.categories.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
