<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::paginate(10);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'destription'=> 'nullable',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);
        Products::create($validated);
        return redirect()->route('products.index')->with('success','Product succesfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        return view('products.edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        $validated = $request->validate([
            'product_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'destription'=> 'nullable',
            'stock' => 'required|integer',
            'price' => 'required|integer'
        ]);
        $products->update($validated);
        return redirect()->route('products.index')->with('success','Product succesfully added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
