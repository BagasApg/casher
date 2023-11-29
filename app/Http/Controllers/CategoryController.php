<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::all();
        return view('category.category', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required'
        ]);
        $cat = new Category();
        $cat->name = $request->name;
        $cat->save();
        return redirect()->back()->with('message', 'Category '. $request->name . ' successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
        ]);
        $cat = Category::find($id);
        $cat->name = $request->name;
        $cat->save();
        return back()->withErrors(['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $cat = Category::find($id);
        $cat->delete();
        return redirect()->back()->with('message', 'Category ' . $cat->name . ' successfully deleted!');
    }
}
