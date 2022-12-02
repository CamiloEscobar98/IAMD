<tr>
    <td>{{ getParamObject($item->director, 'name') }}</td>
    <td>{{ $item->name }}</td>
    <td>
        <b>{{ getParamObject($item, 'contract') }}</b>
        <p>{{ getParamObject($item, 'date') }} <br>
            {{ getParamObject($item->contract_type, 'name') }}-
            {{ getParamObject($item->contract_type, 'code', true) }}</p>
    </td>
    <td>
        @forelse ($item->project_financings as $projectFinancing)
            <b>{{ getParamObject($projectFinancing, 'name') }}</b>
            <p>{{ getParamObject($projectFinancing, 'code', true) }}</p>
        @empty
        @endforelse
    </td>
    <td>
        {{ __('pages.client.projects.table.body.intangible_assets_count', ['intangible_assets' => $item->intangible_assets_count]) }}
    </td>
    @canany(['projects.show', 'projects.destroy'])
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @can('projects.show')
                        <a href="{{ getClientRoute('client.projects.show', [$item->id]) }}" class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endcan
                    @can('projects.destroy')
                        <form action="{{ getClientRoute('client.projects.destroy', [$item->id]) }}"
                            id="form-delete-{{ $item->id }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="dropdown-item" onclick="destroy(event, {{ $item->id }})">
                                <i class="fas fa-sm fa-trash"></i> Borrar
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </td>
    @endcanany
</tr>
