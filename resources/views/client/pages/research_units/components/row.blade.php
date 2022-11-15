<tr>
    <td class="text-center">{{ $loop->iteration }}.</td>
    <td>{{ getParamObject($item->administrative_unit, 'name') }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->code }}</td>
    <td>{{ getParamObject($item->research_unit_category, 'name') }}</td>
    <td>{{ getParamObject($item->director, 'name') }}</td>
    <td>{{ getParamObject($item->inventory_manager, 'name') }}</td>
    <td>
        {{ __('pages.client.research_units.table.body.projects_count', ['projects' => $item->projects_count]) }}
    </td>
    <td>{{ transformTimestampToString($item->created_at) }}</td>
    <td>{{ transformTimestampToString($item->updated_at) }}</td>
    <td>
        <div class="row justify-content-center">
            <a href="{{ route('client.research_units.show', [$client->name, $item->id]) }}"
                class="btn btn-sm btn-secondary">
                <i class="fas fa-sm fa-eye"></i>
            </a>
            <form action="{{ route('client.research_units.destroy', [$client->name, $item->id]) }}"
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
