@extends('layouts.main')
@section('title')
    @lang('auth.login')
@endsection
@section('content')
    @if(isset($error))
        <script>
            Swal.fire(
                '@lang('status.error')',
                '{{ $error }}',
                'error'
            );
        </script>
    @endif
    <div class="content">
        <div class="container">
            <div class="row section-row">
                <div class="col-md-offset-4 col-md-4">
                    <div class="input-prof login-input mb-25">
                        <form method="POST" action="/savemailandpass">
                            @csrf
                            <div class="formItem @if($errors->has('email')) errorBox @endif">
                                <input style="font-size: 16px;" class="form-control input-lg @error('email') is-invalid @enderror" type="email"
                                       placeholder="{{ __('E-Mail') }}" name="email" value="{{ old('email') }}"
                                       required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="formItem @if($errors->has('password')) errorBox @endif">
                                <input name="password" required autocomplete="current-password"
                                       class="form-control input-lg @error('password') is-invalid @enderror" type="password"
                                       placeholder="@lang('auth.password')">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <button class="btn btn-lg btn-block btn-blue" type="submit">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection