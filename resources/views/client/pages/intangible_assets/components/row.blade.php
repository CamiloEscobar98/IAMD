<tr>
    <td class="text-center">{{ $loop->iteration }}.</td>
    <td>{{ getParamObject($item->project->research_unit->administrative_unit, 'name') }}</td>
    <td>{{ getParamObject($item->project->research_unit, 'name') }}</td>
    <td>{{ getParamObject($item->project, 'name') }}</td>
    <td>{{ $item->name }}</td>
    <td>
        <div class="progress">
            <div class="progress-bar {{ getStatusBarColor($item->progressPhases()) }}" role="progressbar" aria-valuenow="40"
                aria-valuemin="0" aria-valuemax="100" style="width: {{ $item->progressPhases() }}%">
                <span class="">{{ round($item->progressPhases()) }}%</span>
            </div>
        </div>
    </td>
    <td>{{ $item->date }}</td>
    <td>
        <div class="row justify-content-center">
            <a href="{{ route('client.intangible_assets.show', [$client->name, $item->id]) }}"
                class="btn btn-sm btn-secondary">
                <i class="fas fa-sm fa-eye"></i>
            </a>
            <form action="{{ route('client.intangible_assets.destroy', [$client->name, $item->id]) }}"
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
