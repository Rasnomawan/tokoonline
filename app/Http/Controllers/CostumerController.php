<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('costumer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('costumer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name',
            'email'
        ]);
        Costumer::create($validasi);
        return redirect()->route('costumer.index')->with('success','Costumer data insert succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Costumer $costumer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Costumer $costumer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Costumer $costumer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Costumer $costumer)
    {
        //
    }
}
