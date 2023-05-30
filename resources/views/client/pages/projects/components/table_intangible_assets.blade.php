<div class="pl-3 py-2 bg-danger text-white">
    <h5 class="font-weight-bold">{{ __('pages.client.projects.intangible_assets.title') }}</h5>
</div>

<div class="table-responsive">
    <table class="table table-sm  table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>{{ __('pages.client.intangible_assets.table.head.name') }}</th>
                <th style="width: 20em">{{ __('pages.client.intangible_assets.table.head.status') }}</th>
                @if (role_can_permission(['intangible_assets.show', 'intangible_assets.destroy']))
                    <th class="text-right" style="width: 5em">#</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($item->intangible_assets as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar {{ getStatusBarColor($item->progressPhases()) }}"
                                role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                style="width: {{ $item->progressPhases() }}%">
                                <span class="">{{ round($item->progressPhases()) }}%</span>
                            </div>
                        </div>
                    </td>
                    @if (role_can_permission(['intangible_assets.show', 'intangible_assets.destroy']))
                        <td class="text-right">
                            <div class="btn-group">
                                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block"
                                    data-toggle="dropdown">
                                    <span class="fas fa-cog"></span>
                                </button>
                                <div class="dropdown-menu">
                                    @if (role_can_permission('intangible_assets.show'))
                                        <a href="{{ getClientRoute('client.intangible_assets.show', [$item->id]) }}"
                                            class="dropdown-item">
                                            <i class="fas fa-sm fa-eye"></i> Ver
                                        </a>
                                    @endif
                                    @if (role_can_permission('intangible_assets.destroy'))
                                        <form
                                            action="{{ getClientRoute('client.intangible_assets.destroy', [$item->id]) }}"
                                            id="form-delete-{{ $item->id }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="dropdown-item"
                                                onclick="destroy(event, {{ $item->id }})">
                                                <i class="fas fa-sm fa-trash"></i> Borrar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="12">{{ __('pages.default.empty_table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
