@extends('layouts.app')

@section('content')
<div class="container" style="min-height: 85vh;">
    <div class="row mb-0 mt-3">
        <div class="col-md-4 mb-3 px-4">
            @if(file_exists(public_path().'\storage/'.$user->display_picture_link))
                <img id="preview-img" src="{{asset('storage/'.$user->display_picture_link)}}" alt="" class="w-100 rounded-circle shadow-sm bg-dark" style="aspect-ratio: 1 / 1; object-fit: cover;">
            @else
                <img id="preview-img" src="{{$user->display_picture_link}}" alt="" class="w-100 rounded-circle shadow-sm bg-dark" style="aspect-ratio: 1 / 1; object-fit: cover;">
            @endif
        </div>
        <div class="col-md-8">
            <div class="card shadow rounded px-2 py-3">
                <div class="card-body">
                    <div class="fs-1 text-center fw-semibold mb-3">
                        {{ __('messages.update_profile') }}
                    </div>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <label for="first_name" class="col col-form-label text-md-right d-flex " >{{ __('messages.first_name') }} </label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" autofocus placeholder="{{__('messages.first_name_placeholder')}}">
                                @error('first_name')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="col col-form-label text-md-right d-flex " >{{ __('messages.last_name') }} </label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" placeholder="{{__('messages.last_name_placeholder')}}">
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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email" placeholder="{{__('messages.email_placeholder')}}">
                                    @error('email')
                                        <span class="invalid-feedback " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="col col-form-label text-md-right d-flex ">{{__('messages.role')}}</label>
                                <input id="role" type="text" class="form-control" name="role" value="{{ $user->role->role_name }}" autocomplete="email" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="col col-form-label text-md-left">{{__('messages.gender')}}</label>
                                <div class="btn-group w-100" role="group" id="gender">
                                    @foreach ($genders as $gender)
                                        <input type="radio" class="btn-check" name="gender" value="{{$gender->gender_id}}" id="{{$gender->gender_desc}}" autocomplete="off" {{$user->gender_id == $gender->gender_id ? "checked" : ""}}>
                                        <label class="btn btn-outline-dark" for="{{$gender->gender_desc}}">{{__($gender->gender_desc)}}</label>
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

                        <div class="row mb-0 justify-content-center">
                            <div class="col-md-6 my-3">
                                <button type="submit" class="btn btn-secondary w-100" >
                                    {{ __('messages.save_changes') }}
                                </button>
                            </div>
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
</script>
@endsection
