@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <button onclick="startFCM()"
                        class="btn btn-danger btn-flat">Allow notification
                </button>

                <div class="card mt-3">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('send.web-notification') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Message Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label>Message Body</label>
                                <textarea class="form-control" name="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>

    <script>
        var firebaseConfig = {
            apiKey: 'AIzaSyCii46DQ9lOoQzFnDIcmw4wYN-yRtejCXI',
            authDomain: 'buginsoft-c1e94.firebaseapp.com',
            databaseURL: 'https://buginsoft-c1e94.firebaseio.com',
            projectId: 'buginsoft-c1e94',
            storageBucket: 'buginsoft-c1e94.appspot.com',
            messagingSenderId: '222894391713',
            appId: '1:222894391713:android:26271e70365b57922b0be0',
            measurementId: 'G-measurement-id',
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function startFCM() {
            messaging
                .requestPermission()
                .then(function () {
                    console.log(messaging.getToken());
                    return messaging.getToken()
                })
                .then(function (response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("store.token") }}',
                        type: 'POST',
                        data: {
                            token: response
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            alert('Token stored.');
                        },
                        error: function (error) {
                            alert(error);
                        },
                    });

                }).catch(function (error) {
                alert(error);
            });
        }

        messaging.onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });

    </script>
@endsection
