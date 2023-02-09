<div class="card shadow-sm mb-4 p-3">
    <div class="row g-2 justify-content-center align-items-center">
      <img src="{{$item->item_image}}" class="col-md-2 rounded-circle m-4" alt="..." style="aspect-ratio:1/1; object-fit: cover">
      <div class="col-md-3">
        <div class="fs-4 fw-semibold">{{$item->item_name}}</div>
      </div>
      <div class="col-md-3">
        <p class="fs-5 fw-bold mb-0">{{__('messages.price').': '.__('messages.currency').' '.number_format($item->price, 0, ',', '.')}}</p>
      </div>
      <div class="col-md-2">
        <form action="{{route('cart.delete', ['id' => $order->order_id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger text-white" >
                <i class="bi bi-trash-fill"></i>
                <span>{{__('messages.delete')}}</span>
            </button>
        </form>
      </div>
    </div>
</div>
