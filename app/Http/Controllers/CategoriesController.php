<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Categories::all();
        return view('categories.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_category' => 'required',
        ]);
        Categories::create($validated);
        return redirect()->route('categories.index')->with('success','Category added succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $category)
    {
        $validated = $request->validate([
            'name_category' => 'required',
        ]);
        $category->update($validated);
        return redirect()->route('categories.index')->with('success','Category successfully update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $category)
    {
        if(!$category->product()->exists()){
            $category->delete();
        return redirect()->route('categories.index')->with('success','Category successfully deleted');
        }else{
            return redirect()->route('categories.index')->with('error','Category has products, cannot be deleted');
        }
    }
}
