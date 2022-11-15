<tr>
    <td class="text-center">{{ $loop->iteration }}.</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->information }}</td>
    <td>
        {{ __('pages.client.administrative_units.table.body.research_units_count', ['research_units_count' => $item->research_units_count]) }}
    </td>
    <td>{{ transformTimestampToString($item->created_at) }}</td>
    <td>{{ transformTimestampToString($item->updated_at) }}</td>
    <td>
        <div class="row justify-content-center">
            <a href="{{ route('client.administrative_units.show', [$client->name, $item->id]) }}"
                class="btn btn-sm btn-secondary">
                <i class="fas fa-sm fa-eye"></i>
            </a>
            <form action="{{ route('client.administrative_units.destroy', [$client->name, $item->id]) }}"
                id="form-delete-{{ $item->id }}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-sm btn-danger" onclick="destroy(event, {{ $item->id }})">
                    <i class="fas fa-sm fa-trash"></i>
                </button>
            </form>

        </div>
    </td>
</tr>
