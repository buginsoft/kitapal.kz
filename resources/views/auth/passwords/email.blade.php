@extends('layouts.main')
@section('title')
    @lang('auth.ResetPassword')
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row section-row">
                <div class="col-md-offset-4 col-md-4">
                    <p class="fs-24 mb-25"><b>{{ __('auth.ResetPassword') }}</b></p>
                    <div class="input-prof login-input mb-25">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="formItem @if($errors->has('email')) errorBox @endif">
                                <input id="email" style="font-size: 16px;" class="form-control input-lg @error('email') is-invalid @enderror" type="email"
                                       placeholder="{{ __('E-Mail') }}" name="email" value="{{ old('email') }}"
                                       required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-lg btn-block btn-blue" type="submit">{{ __('auth.SendPasswordResetLink') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection