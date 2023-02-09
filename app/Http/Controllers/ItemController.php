<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function detail($lang, $id){
        $item = Item::find($id);

        if(!$item) return redirect()->route('home', ['lang' => $lang])->with('fail', __('messages.item_not_exist'));

        return view('detail', compact('item'));
    }
}
