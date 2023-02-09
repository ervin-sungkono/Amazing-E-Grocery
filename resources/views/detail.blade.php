@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center" style="min-height: 85vh">
    <div class="row row-cols-1 row-cols-md-2 d-flex justify-content-center align-items-center mb-4">
        <div class="col-md-4 mb-3">
            <img src={{$item->item_image}} alt="" class="w-100 rounded-circle shadow-sm" style="aspect-ratio: 1 / 1; object-fit: cover;">
        </div>
        <div class="col-md-8">
            <div class="d-flex flex-column mb-3">
                <div class="display-6 fw-bold mb-3">{{$item->item_name}}</div>
                <p class="fs-5 fw-bold">{{__('messages.price').': '.__('messages.currency').' '.number_format($item->price, 0, ',', '.')}}</p>
                <p class="text-muted">{{$item->item_desc}}</p>
            </div>
            <form action="{{route('cart.store')}}" method="POST" class="col-md-4 ">
                @csrf
                <input type="hidden" name="item_id" value="{{$item->item_id}}">
                <button type="submit" class="w-100 btn btn-secondary">{{__('messages.add_to_cart')}}</button>
            </form>
        </div>
    </div>
</div>
@endsection
