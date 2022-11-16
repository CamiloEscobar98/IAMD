<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ __('pages.admin.localizations.cities.table.head.name') }}</th>
                <th class="text-right" style="width: 5em">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cities as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td class="text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('admin.localizations.cities.show', $item->id) }}"
                                    class="dropdown-item">
                                    <i class="fas fa-sm fa-eye"></i> Ver
                                </a>
                                <form action="{{ route('admin.localizations.cities.destroy', $item->id) }}"
                                    id="form-delete-{{ $item->id }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="dropdown-item"
                                        onclick="destroy(event, {{ $item->id }})">
                                        <i class="fas fa-sm fa-trash"></i> Borrar
                                    </button>
                                </form>
                            </div>


                        </div>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="12">{{ __('pages.default.empty_table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
