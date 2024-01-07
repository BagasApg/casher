<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Item::all();
        return view('transaction', compact('items'));
    }

    public function add($id){
        $item = Item::findorfail($id);
        $cart = session()->get('cart');
        $cart_subtotal = session()->get('cart_subtotal');

        if(isset($cart[$id])){
            $cart[$id]['qty'] += 1;
            $cart[$id]['subtotal'] = $item->price * $cart[$id]['qty'];
        } else {
            $cart[$id] = [
                'id' => $item->id,
                'name' => $item->name,
                'qty' => 1,
                'subtotal' => $item->price,
            ];
        }
        // if(isset($cart['total'])){
            $cart_subtotal += $item->price;

        // } else {
            // $cart_subtotal = $cart[$id]['subtotal'];
        // }

        session()->put('cart', $cart);
        session()->put('cart_subtotal', $cart_subtotal);

        return redirect()->back();
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function cartUpdate(Request $request){
        $item = Item::findorfail($request->id);
        $id = $request->id;
        
        $cart = session('cart');
        // dd($cart);
        $current_subtotal = $cart[$id]['subtotal'];
        
        $cart[$id]['qty'] = $request->qty;
        $cart[$id]['subtotal'] = $item->price * $request->qty;

        $cart_subtotal = session('cart_subtotal');
        $current_subtotal_buffer = $item->price * $request->qty;

        $cart_subtotal += $current_subtotal_buffer;
        $cart_subtotal -= $current_subtotal;

        session()->put('cart_subtotal', $cart_subtotal);
        session()->put('cart', $cart);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = session('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function flush(){
        // dd(session()->get('cart'));
        session()->flush();
        return redirect()->back();
    }

}
