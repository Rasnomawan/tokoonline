<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'description'=> 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'stock' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagename = time() . '-' . $image->getClientOriginalName();
            $locate = $image->storeAs('uploads/image_group',$imagename,'public');
            $validated['image'] = $locate;
         }
        
        Products::create($validated);
        return redirect()->route('products.index')->with('success','Product succesfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        $categories = Categories::all();
        return view('products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $validated = $request->validate([
            'product_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description'=> 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'stock' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $image = $request->file('image');
            $imagename = time() . '_' . $image->getClientOriginalName();
            $locate = $image->storeAs('uploads/image_group', $imagename, 'public');
            $validated['image'] = $locate;
        }
        $product->update($validated);
        return redirect()->route('products.index')->with('success','Product update succesfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        if(!$product->transaction()->exists()){
        $product->delete();
        return redirect()->route('products.index')->with('success','Data has been successfully delete');
        }else{
            return redirect()->route('products.index')->with('error','Data cannot be deleted because it has');
        }
    }
}
