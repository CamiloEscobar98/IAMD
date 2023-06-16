<tr>
    <td>{{ $item->message }}</td>
    <td>Hace aproximadamente {{ $item->minutes }}</td>
    <td>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck" @checked($item->checked_at) disabled>
            <label class="custom-control-label" for="customCheck">Leído</label>
        </div>
    </td>
</tr>
