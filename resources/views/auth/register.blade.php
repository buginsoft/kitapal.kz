@extends('layouts.main')
@section('title')
    @lang('auth.register')
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row section-row">
                <div class="col-md-offset-4 col-md-4">
                    <p class="fs-24 mb-25">
                        <b>{{ __('auth.register') }}</b>
                    </p>
                    <div class="input-prof login-input mb-25">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="formItem @if($errors->has('name')) errorBox @endif">
                                <input name="name" value="{{ old('name') }}" class="form-control input-lg @error('name') is-invalid @enderror" type="text" placeholder="{{ __('Profile.fio') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="formItem @if($errors->has('email')) errorBox @endif">
                                <input name="email" value="{{ old('email') }}" class="form-control input-lg @error('email') is-invalid @enderror" type="email" placeholder="E-mail" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="formItem @if($errors->has('password')) errorBox @endif">
                                <input name="password" required autocomplete="new-password" class="form-control input-lg @error('password') is-invalid @enderror" type="password" placeholder="@lang('auth.password')">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <input name="password_confirmation" required autocomplete="new-password" class="form-control input-lg" type="password" placeholder="{{ __('auth.confirmpassword') }}">
                            <button class="btn btn-lg btn-block btn-blue" type="submit">{{ __('auth.register') }}</button>
                            <a href="/login" class="btn btn-lg btn-block btn-border-blue" type="button">{{ __('auth.tologin') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection