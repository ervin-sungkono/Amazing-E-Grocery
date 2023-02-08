<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class HomeController extends Controller
{
    public function index(){
        $items = Item::paginate(10);
        return view('home', compact('items'));
    }
}
