@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center" style="min-height: 85vh">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow rounded px-2 py-3">
                <div class="card-body">
                    <div class="fs-1 text-center fw-semibold mb-3">
                        {{ __('messages.update_role') }}
                    </div>
                    <form method="POST" action="{{ route('role.update', ['id' => $user->user_id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3 ">
                            <div class="col">
                                <label for="full_name">{{__('messages.full_name')}}</label>
                                <input type="text" id="full_name" class="form-control" value="{{ $user->first_name.' '.$user->last_name }}" readonly disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="role" class="col col-form-label text-md-right d-flex ">{{__('messages.role')}}</label>
                                <select id="role" class="form-select  @error('role') is-invalid @enderror" name="role">
                                    <option selected disabled>{{__('messages.select_role')}}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->role_id}}" {{$user->role_id == $role->role_id ? "selected" : ""}}>{{$role->role_name}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col my-3">
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
