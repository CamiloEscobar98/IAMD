<tr>
    <td>{{ getParamObject($item->director, 'name') }}</td>
    <td>{{ $item->name }}</td>
    <td>
        <b>{{ getParamObject($item, 'contract') }}</b>
        <p>{{ getParamObject($item, 'date') }} <br>
            {{ getParamObject($item->contract_type, 'name') }}
        </p>
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
    <td>{{ transformDatetoString($item->date) }}</td>
    @if (role_can_permission(['projects.show', 'projects.destroy']))
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @if (role_can_permission('projects.show'))
                        <a href="{{ getClientRoute('client.projects.show', [$item->id]) }}" class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endif
                    @if (role_can_permission('projects.destroy'))
                        <form action="{{ getClientRoute('client.projects.destroy', [$item->id]) }}"
                            id="form-delete-{{ $item->id }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="dropdown-item" onclick="destroy(event, {{ $item->id }})">
                                <i class="fas fa-sm fa-trash"></i> Borrar
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </td>
    @endif
</tr>
