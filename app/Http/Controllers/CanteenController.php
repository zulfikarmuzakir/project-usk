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
            'stock' => 'required|numeric',
        ]);

        Item::create($data);

        return redirect()->back()->with('success', 'Item created successfully');
    }
    public function update($id)
    {
        $item = Item::find($id);

        $data = request()->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|numeric',
        ]);

        $item->update($data);

        return redirect()->back()->with('success', 'Item updated successfully');
    }
    
    public function delete($id)
    {
        $item = Item::find($id);

        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully');
    }
}
