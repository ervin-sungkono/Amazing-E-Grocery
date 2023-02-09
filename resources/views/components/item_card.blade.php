<div class="d-flex flex-column mb-3" style="width: 14rem;">
    <img src="{{$item->item_image}}" class="rounded-circle m-4 shadow" alt="{{$item->item_name}}" style="aspect-ratio: 1 / 1; object-fit: cover">
    <div class="card h-100">
        <div class="card-body d-flex flex-column align-items-center">
            <h5 class="card-title text-center fw-bold flex-grow-1">{{$item->item_name}}</h5>
            <p class="fw-bold">IDR {{number_format($item->price, 0, ',', '.')}}</p>
            <a href="{{route('item.detail', ['id' => $item->item_id, 'lang' => App::getLocale()])}}" class="btn btn-outline-primary fw-bold w-100">{{__('messages.see_detail')}}</a>
        </div>
    </div>
</div>
