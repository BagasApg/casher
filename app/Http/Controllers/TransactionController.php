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
        $cart = session('cart');

        $ids = [];
        if(!is_null($cart)){

            foreach($cart as $cart_item){
                array_push($ids, $cart_item->id);
            }
        }
        
        
        if(is_null($cart)){
            $cart = [];
        }
        // dd($items);
        return view('transaction', compact('items', 'cart', 'ids'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addItem(Request $request, string $id){
        // dd($id);
        // session(['cart' => '']);
        // session()->flush();
        

        $item = Item::find($id);
        $cart = session('cart');
        if(is_null($cart)){
            $cart = [];
        }

        $ids = [];
        
        
        foreach($cart as $cart_item){
            array_push($ids, $cart_item->id);
        }
        // dd($ids);
        if(in_array($id, $ids)){
            return redirect()->back();

        } else {
            $itemBuffer = (object) [
                'id' => $item->id,
                'name' => $item->name,
                'category_id' => $item->category_id,
                'stock' => $item->stock,
                'price' => $item->price,
            ];
    
            array_push($cart, $itemBuffer);
            session(['cart' => $cart]);
        }

        
        // dd(session('cart'));
        return redirect()->back();


        // $objs = [];

        // $obj = (object)[];
        // $obj->tes = "tes";
        // $obj->test = "secondary";

        // array_push($objs, $obj);
        // dd($objs[0]->test);

        // $objs = [
        //     (object) array('id' => 1, 'name' => "Bagas"),
        //     (object) array('id' => 1, 'name' => "Bagas"),
        //     (object) array('id' => 1, 'name' => "Bagas"),
        // ];
        // dd($objs);

        

        
            
        // dd(session('user'));
    }

    public function removeItem($id){
        // dd($id);
        $cart = session('cart');
        $ids = [];

        foreach($cart as $item){
            array_push($ids, $item->id);
        }

        // dd($ids);
        // dd(array_search($id, $ids));

        $key_buffer = array_search($id, $ids);
        unset($cart[$key_buffer]);
        $cart = array_values($cart);

        session(['cart' => $cart]);
        return redirect()->back();

    }

    public function check(){
        
        dd(session('cart'));
    }

    public function flush(){
        session()->flush();
        return redirect()->back();
    }
}
