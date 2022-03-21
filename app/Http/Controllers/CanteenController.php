<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CanteenController extends Controller
{
    public function items()
    {
        $items = Item::all();

        return view('canteen.items.index', compact('items'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        Item::create($data);

        return redirect()->back()->with('success', 'Item created successfully');
    }
}
