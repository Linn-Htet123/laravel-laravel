<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory.index',['items'=>Item::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = Item::create([
            "name"=>$request->name,
            "price"=>$request->price,
            "stock"=>$request->stock,
        ]);
        return redirect()->route('inventory.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('inventory.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {

        return view('inventory.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->update();
        return redirect()->route('inventory.show', ['item' => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->back();
    }
}
