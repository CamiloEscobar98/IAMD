<tr>
    <td class="text-center">{{ $loop->iteration }}.</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->description }}</td>
    <td>
        {{ __('pages.client.projects.table.body.intangible_assets_count', ['intangible_assets' => $item->intangible_assets_count]) }}
    </td>
    <td>{{ $item->created_at }}</td>
    <td>{{ $item->updated_at }}</td>
    <td>
        <div class="row justify-content-center">
            <a href="{{ route('client.projects.show', [$client->name, $item->id]) }}"
                class="btn btn-sm btn-secondary">
                <i class="fas fa-sm fa-eye"></i>
            </a>
            <form
                action="{{ route('client.projects.destroy', [$client->name, $item->id]) }}"
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