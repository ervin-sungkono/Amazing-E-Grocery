@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center" style="min-height: 85vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow rounded px-2 py-3">
                <div class="card-body">
                    <div class="fs-1 text-center fw-semibold mb-3">
                        {{ __('messages.register') }}
                    </div>
                    <form method="POST" action="{{ route('auth.register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <label for="first_name" class="col col-form-label text-md-right d-flex " >{{ __('messages.first_name') }} </label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autofocus placeholder="{{__('messages.first_name_placeholder')}}">
                                @error('first_name')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="col col-form-label text-md-right d-flex " >{{ __('messages.last_name') }} </label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="{{__('messages.last_name_placeholder')}}">
                                @error('last_name')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="col col-form-label text-md-right d-flex">{{ __('messages.email_address') }} </label>
                                <div class="input-group mb-2">
                                    <i class="bi bi-envelope-fill fs-5 text-primary input-group-text"></i>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{__('messages.email_placeholder')}}">
                                    @error('email')
                                        <span class="invalid-feedback " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="col col-form-label text-md-right d-flex ">{{__('messages.role')}}</label>
                                <select id="role" class="form-select  @error('role') is-invalid @enderror" name="role">
                                    <option selected disabled>{{__('messages.select_role')}}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->role_id}}" {{old('role') == $role->role_id ? "selected" : ""}}>{{$role->role_name}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="col col-form-label text-md-left">{{__('messages.gender')}}</label>
                                <div class="btn-group w-100" role="group" id="gender">
                                    @foreach ($genders as $gender)
                                        <input type="radio" class="btn-check" name="gender" value="{{$gender->gender_id}}" id="{{$gender->gender_desc}}" autocomplete="off" {{$gender->gender_id == 1 ? "checked" : ""}}>
                                        <label class="btn btn-outline-dark" for="{{$gender->gender_desc}}">{{__('messages.'.strtolower($gender->gender_desc))}}</label>
                                    @endforeach
                                </div>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="col col-form-label text-md-left">{{ __('messages.display_picture') }}</label>
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" onchange="preview()">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="col col-form-label text-md-left">{{ __('messages.password') }}</label>
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
                            <div class="col-md-6">
                                <label for="password_confirmation" class="col col-form-label text-md-left">{{ __('messages.confirm_password') }}</label>
                                <div class="input-group mb-2">
                                    <i class="bi bi-key-fill fs-5 text-primary input-group-text"></i>
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="{{__('messages.confirm_password_placeholder')}}"">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-6">
                                <label for="preview-img" class="col col-form-label text-center">{{ __('messages.preview_image') }}</label>
                                <img src="{{asset('images/preview-img.png')}}" onerror="this.src='{{asset('images/preview-img.png')}}'"class="bg-dark rounded shadow-m mb-3 w-100" id="preview-img" style="object-fit: cover; aspect-ratio: 1/1; cursor: pointer;" onclick="openFile()">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col my-3">
                                <button type="submit" class="btn btn-secondary w-100" >
                                    {{ __('messages.submit') }}
                                </button>
                            </div>
                            <a href="{{route('login')}}" class="btn btn-link">{{__('messages.login_link')}}</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function preview() {
        const url = URL.createObjectURL(event.target.files[0]);
        document.getElementById('preview-img').src = url;
    }
    function openFile() {
        document.getElementById('image').click();
    }
</script>
@endsection
