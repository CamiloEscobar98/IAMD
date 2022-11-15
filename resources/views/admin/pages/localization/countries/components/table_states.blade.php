<div class="table-responsive">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead class="text-center">
            <tr>
                <th>{{ __('pages.admin.localizations.countries.table.head.name') }}</th>
                <th class="">{{ __('pages.admin.localizations.countries.table.head.cities') }}</th>
                <th class="text-right">#</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($states as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>
                        @forelse ($item->cities as $subItem)
                            <span class="btn btn-xs btn-light m-1">{{ $subItem->name }}</span>
                        @empty
                        @endforelse
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('admin.localizations.states.show', $item->id) }}"
                                    class="dropdown-item btn btn-sm btn-info">
                                    <i class="fas fa-sm fa-eye"></i> Ver
                                </a>
                                <form action="{{ route('admin.localizations.states.destroy', $item->id) }}"
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
