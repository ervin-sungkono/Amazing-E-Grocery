@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh">
    <div class="border border-secondary rounded-circle p-4 d-flex flex-column justify-content-center align-items-center" style="width:80vmin; height:80vmin; border-width: clamp(10px, 2vw, 20px)!important">
        <h1 class="text-white text-center fw-semibold" style="z-index: 1">{{__('messages.welcome')}}</h1>
        <a href="{{route('login')}}" class="btn btn-lg btn-secondary mt-3">{{__('messages.start')}}</a>
    </div>
</div>
@endsection

@section('background')
style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{asset('images/background.jpg')}}); background-size: cover; background-position: center;"
@endsection
