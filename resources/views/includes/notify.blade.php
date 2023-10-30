@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script>
            Swal.fire({
                icon: '{{$msg[0]}}',
                text: '{{$msg[1]}}'
            })
        </script>
    @endforeach
@endif