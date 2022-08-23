@if ($alert = session()->get('alert'))
    <script>
        Swal.fire({
            title: "{{ $alert['title'] }}",
            icon: "{{ $alert['icon'] }}",
            html: "{!! $alert['text'] !!}",
        });
    </script>
@endif
