<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Auth::user()->orders;

        return view('cart', compact('orders'));
    }

    public function store(Request $request){
        $item = Item::find($request->item_id);

        if(!$item) return redirect()->route('home')->with('fail', __('messages.item_not_exist'));

        $order = Order::firstOrCreate([
            'user_id' => Auth::user()->user_id,
            'item_id' => $item->item_id,
        ],[
            'price' => $item->price
        ]);

        $status = $order->wasRecentlyCreated ? "success" : "fail";
        $message = $order->wasRecentlyCreated ? __('messages.item_added') : __('messages.item_exist_in_cart');

        return redirect()->route('item.detail', ['id' => $item->item_id, 'lang' => session('locale')])->with($status, $message);
    }

    public function delete($id){
        $order = Order::findOrFail($id);

        $status = $order->delete() ? 'success' : 'fail';
        $message = $status == 'success' ? __('messages.order_delete_success') : __('messages.order_delete_fail');

        return redirect()->route('cart', ['lang' => session('locale')])->with($status, $message);
    }

    public function checkout(){
        $orders = Auth::user()->orders;

        foreach($orders as $order){
            $order->item->delete();
        }

        $orders = Order::where('user_id', Auth::user()->user_id)->get();

        $status = $orders->count() == 0 ? 'success' : 'fail';
        $message = $status == 'success' ? __('messages.checkout_success') : __('messages.checkout_fail');

        return redirect()->route('cart', ['lang' => session('locale')])->with($status, $message);
    }
}
