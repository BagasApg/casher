<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $cats = Category::all();
        return view('item', compact('items', 'cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd("halo");
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ]);

        // dd($request);
        $item = new Item();
        $item->name = $request->name;
        $item->category_id = $request->category;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);
        return $item;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->back()->with('message', 'Item ' . $item->name . ' successfully deleted!');
    }
}
