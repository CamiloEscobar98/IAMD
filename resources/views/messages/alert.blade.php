@if ($alert = session()->get('alert'))
    <script>
        Swal.fire({
            position: 'bottom-end',
            title: "{{ $alert['title'] }}",
            icon: "{{ $alert['icon'] }}",
            html: "{!! $alert['text'] !!}",
            timer: 2000,
            timerProgressBar: true,
        });
    </script>
@endif
