@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="container">
            <div class="row section-row">
                <div class="col-md-offset-4 col-md-4">
                    <p class="fs-24 mb-25"><b>{{ __('auth.ResetPassword') }}</b></p>
                    <div class="input-prof login-input mb-25">

                        <form method="POST" action="/auth/setNewPassword">
                            <input type="hidden" name="hash_email" value="{{$hash}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="formItem @if($errors->has('email')) errorBox @endif">
                                <input id="email" style="font-size: 16px;"
                                       class="form-control input-lg @error('email') is-invalid @enderror" type="email"
                                       placeholder="{{ __('E-Mail') }}" name="email" value="{{ $email ?? old('email') }}"
                                       required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="formItem @if($errors->has('password')) errorBox @endif">
                                <input id="password" name="password" required autocomplete="new-password"
                                       class="form-control input-lg @error('password') is-invalid @enderror" type="password"
                                       placeholder="@lang('auth.password')">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <input id="password-confirm" name="password_confirmation" required autocomplete="new-password"
                                   class="form-control" type="password"
                                   placeholder="{{ __('auth.confirmpassword') }}">
                            <button class="btn btn-lg btn-block btn-blue" type="submit">{{ __('auth.ResetPassword') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection