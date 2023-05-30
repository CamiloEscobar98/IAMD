<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->phone }}</td>
    <td>{!! __('pages.client.creators.external.table.body.document', [
        'document' => $item->creator->document->document,
        'type' => $item->creator->document->document_type->name,
        'expedition' => $item->creator->document->expedition_place->name,
    ]) !!}</td>
    <td> {{ getParamObject($item->external_organization, 'name', true) }} </td>
    <td> {{ getParamObject($item->assignment_contract, 'name', true) }} </td>
    <td>{{ transformDatetoString($item->created_at) }}</td>
    @if (role_can_permission(['creators.external.show', 'creators.external.destroy']))
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @if (role_can_permission('creators.external.show'))
                        <a href="{{ getClientRoute('client.creators.external.show', [$item->creator_id]) }}"
                            class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endif
                    @if (role_can_permission('creators.external.destroy'))
                        <form action="{{ getClientRoute('client.creators.external.destroy', [$item->creator_id]) }}"
                            id="form-delete-{{ $item->creator_id }}" method="post">
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
