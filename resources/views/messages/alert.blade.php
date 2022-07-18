@if ($alert = session()->get('alert'))
    <script>
        Swal.fire({
            title: "{{ $alert['title'] }}",
            icon: "{{ $alert['icon'] }}",
            text: "{{ $alert['text'] }}"
        });
    </script>
@endif
