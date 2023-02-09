@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center" style="min-height: 85vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow rounded px-2 py-3">
                <div class="card-body">
                    <div class="fs-1 text-center fw-semibold mb-3">
                        {{ __('messages.login') }}
                    </div>
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="row mb-3 ">
                            <label for="email" class="col col-form-label text-md-right d-flex " >{{ __('messages.email_address') }} </label>
                            <div class="input-group mb-2">
                                <i class="bi bi-envelope-fill fs-5 text-primary input-group-text"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{__('messages.email_placeholder')}}">
                                @error('email')
                                <span class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('messages.password') }}</label>
                            <div class="input-group mb-2">
                                <i class="bi bi-key-fill fs-5 text-primary input-group-text"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{__('messages.password_placeholder')}}"">
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
                                        {{ __('messages.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col my-3">
                                <button type="submit" class="btn btn-secondary w-100" >
                                    {{ __('messages.submit') }}
                                </button>
                            </div>
                            <a href="{{route('register')}}" class="btn btn-link">{{__('messages.register_link')}}</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
