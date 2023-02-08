@extends('layouts.app')

@section('content')
<div class="container" style="min-height: 85vh">
    <h1 class="text-center fw-bold mb-4">{{__('Cart')}}</h1>
    @if($orders->count() > 0)
        <div class="row row-cols-1 mb-3">
            @foreach ($orders as $order)
                <div class="col">
                    @include('components.cart_card',array(
                        'order' => $order,
                        'item' => $order->item
                    ))
                </div>
            @endforeach
        </div>
        <div class="row justify-content-end">
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <h5 class="fw-semibold mb-0">
                    {{__('Total'.': '.__('IDR').' '.number_format($orders->sum('price'), 0, ',', '.'))}}
                </h5>
                <form action="{{route('cart.checkout')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-secondary ms-3">{{__('Checkout')}}</button>
                </form>
            </div>
        </div>
    @else
        <h2 class="text-center">{{__("No items found in cart")}}</h2>
    @endif
</div>
@endsection
