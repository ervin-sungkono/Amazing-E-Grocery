@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center" style="min-height: 85vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow rounded px-2 py-3">
                <div class="card-body">
                    <div class="fs-1 text-center fw-semibold mb-3">
                        {{ __('Login') }}
                    </div>
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="row mb-3 ">
                            <label for="email" class="col col-form-label text-md-right d-flex " >{{ __('Email Address') }} </label>
                            <div class="input-group mb-2">
                                <i class="bi bi-envelope-fill fs-5 text-primary input-group-text"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{__('Enter Email Address..')}}">
                                @error('email')
                                <span class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>
                            <div class="input-group mb-2">
                                <i class="bi bi-key-fill fs-5 text-primary input-group-text"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{__('Enter Password..')}}"">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col my-3">
                                <button type="submit" class="btn btn-secondary w-100" >
                                    {{ __('Submit') }}
                                </button>
                            </div>
                            <a href="{{route('register')}}" class="btn btn-link">{{__("Don't have an account? click here to register")}}</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
