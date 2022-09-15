<tr>
    <td class="text-center">{{ $loop->iteration }}.</td>
    <td>{{ $item->project->name }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->created_at }}</td>
    <td>{{ $item->updated_at }}</td>
    <td>
        <div class="row justify-content-center">
            <a href="{{ route('client.intangible_assets.show', [$client->name, $item->id]) }}"
                class="btn btn-sm btn-secondary">
                <i class="fas fa-sm fa-eye"></i>
            </a>
            <form
                action="{{ route('client.intangible_assets.destroy', [$client->name, $item->id]) }}"
                id="form-delete-{{ $item->id }}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-sm btn-danger"
                    onclick="destroy(event, {{ $item->id }})">
                    <i class="fas fa-sm fa-trash"></i>
                </button>
            </form>

        </div>
    </td>
</tr>