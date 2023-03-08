<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.category') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.subcategory') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.name') }}</th>
                <th>{{ __('pages.admin.intellectual_property_rights.products.table.head.code') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('admin.pages.intellectual_property_rights.products.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>
