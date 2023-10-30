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
                    <p class="fs-24 mb-25"><b>@lang('auth.login')</b></p>
                    <div class="input-prof login-input mb-25">
                        <form method="POST" action="/login">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="formItem @if($errors->has('email')) errorBox @endif">
                                <input style="font-size: 16px;"
                                       class="form-control input-lg @error('email') is-invalid @enderror" type="email"
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
                                       class="form-control input-lg @error('password') is-invalid @enderror"
                                       type="password"
                                       placeholder="@lang('auth.password')">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <p class="text-right"><a class="text-green" href="{{ route('password.request') }}">
                                    {{ __('auth.forgot') }}</a></p>
                            <button class="btn btn-lg btn-block btn-blue" type="submit">@lang('auth.login')</button>
                            <a href="/register" class="btn btn-lg btn-block btn-border-blue"
                               type="button">@lang('auth.register')</a>
                            <div class="log_icon_text_box">
                                <p>Войти через социальные сети</p>
                            <div class="log_icon_block d-flex">
                                <a href="/login/google" class="btn btn-lg btn-block btn-border-blue log__icon"
                                   type="button"><span class="log__icon"><img src="img/icons/icons8-google-48.png" alt=""></span></a>
                                <a href="/login/facebook" class="btn btn-lg btn-block btn-border-blue log__icon"
                                   type="button"><span class="log__icon"><i class="fab fa-facebook-f"></i></span></a>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection