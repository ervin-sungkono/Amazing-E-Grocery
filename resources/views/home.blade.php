@extends('layouts.app')

@section('content')
<div class="container" style="min-height: 85vh">
    <div class="row mb-0">
        <div class="d-flex flex-wrap justify-content-center gap-3 py-3">
            @foreach ($items as $item)
                @include('components.item_card', array('item' => $item,))
            @endforeach
        </div>
        <div class="d-flex flex-column align-items-center">
            {{$items->onEachSide(1)->withQueryString()->links()}}
            <p class="text-center mt-2">{{__('Page').' '.$items->currentPage()}}</p>
        </div>
    </div>
</div>
@endsection
