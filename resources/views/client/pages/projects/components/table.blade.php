<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th style="width: 15em">{{ __('pages.client.projects.table.head.administrative_unit') }}</th>
                <th style="width: 20em">{{ __('pages.client.projects.table.head.research_unit') }}</th>
                <th>{{ __('pages.client.projects.table.head.director') }}</th>
                <th>{{ __('pages.client.projects.table.head.name') }}</th>
                <th>{{ __('pages.client.projects.table.head.project_financing') }}</th>
                <th>{{ __('pages.client.projects.table.head.intangible_assets') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                @include('client.pages.projects.components.row')
            @empty
                <td colspan="12">{{ __('pages.default.empty_table') }}</td>
            @endforelse
        </tbody>
    </table>
</div>