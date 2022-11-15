<tr>
    <td class="text-center">{{ $loop->iteration }}.</td>
    <td>{{ $item->info }}</td>
    <td>
        {{ __('pages.client.roles.table.body.users_count', ['count' => $item->users_count]) }}
    </td>
    <td>
        {{ __('pages.client.roles.table.body.permissions_count', ['count' => $item->permissions_count]) }}
    </td>
    <td>{{ transformTimestampToString($item->created_at) }}</td>
    <td>{{ transformTimestampToString($item->updated_at) }}</td>
    <td>
        <div class="row justify-content-center">
            <a href="{{ route('client.roles.show', [$client->name, $item->id]) }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-sm fa-eye"></i>
            </a>
            <form action="{{ route('client.roles.destroy', [$client->name, $item->id]) }}"
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
