<tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->phone }}</td>
    <td>{!! __('pages.client.creators.external.table.body.document', [
        'document' => $item->creator->document->document,
        'type' => $item->creator->document->document_type->name,
        'expedition' => $item->creator->document->expedition_place->name,
    ]) !!}</td>
    <td> {{ $item->external_organization->name }} </td>
    <td> {{ $item->assignment_contract->name }} </td>
    @canany(['creators.external.show', 'creators.external.destroy'])
        <td class="text-right">
            <div class="btn-group">
                <button type="button" class="dropdown-toggle btn btn-sm btn-danger btn-block" data-toggle="dropdown">
                    <span class="fas fa-cog"></span>
                </button>
                <div class="dropdown-menu">
                    @can('creators.external.show')
                        <a href="{{ getClientRoute('client.creators.external.show', [$item->creator_id]) }}"
                            class="dropdown-item">
                            <i class="fas fa-sm fa-eye"></i> Ver
                        </a>
                    @endcan
                    @can('creators.external.destroy')
                        <form action="{{ getClientRoute('client.creators.external.destroy', [$item->creator_id]) }}"
                            id="form-delete-{{ $item->creator_id }}" method="post">
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
