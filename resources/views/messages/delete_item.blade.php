<script>
    function destroy(event, id) {
        event.preventDefault();
        Swal.fire({
            title: "{{ $title }}",
            showCancelButton: true,
            confirmButtonText: "{{ __('buttons.sure') }}",
            cancelButtonText: "{{ __('buttons.cancel') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form-delete-" + id).submit();
            }
        });
    }
</script>
