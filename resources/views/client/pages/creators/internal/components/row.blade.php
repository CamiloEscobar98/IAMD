<tr>
    <td class="text-center">{{ $loop->iteration }}.</td>
    <td>{{ $item->name }}</td>
    <td>{!! __('pages.client.creators.internal.table.body.document', [
        'document' => $item->creator->document->document,
        'type' => $item->creator->document->document_type->name,
        'expedition' => $item->creator->document->expedition_place->name,
    ]) !!}</td>
    <td> {{ $item->linkage_type->name }} </td>
    <td> {{ $item->assignment_contract->name }} </td>
    <td>{{ $item->created_at }}</td>
    <td>{{ $item->updated_at }}</td>
    <td>
        <div class="row justify-content-center">
            <a href="{{ route('client.creators.internal.show', [$client->name, $item->id]) }}"
                class="btn btn-sm btn-secondary">
                <i class="fas fa-sm fa-eye"></i>
            </a>
            <form action="{{ route('client.creators.internal.destroy', [$client->name, $item->creator_id]) }}"
                id="form-delete-{{ $item->creator_id }}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-sm btn-danger" onclick="destroy(event, {{ $item->creator_id }})">
                    <i class="fas fa-sm fa-trash"></i>
                </button>
            </form>

        </div>
    </td>
</tr>
