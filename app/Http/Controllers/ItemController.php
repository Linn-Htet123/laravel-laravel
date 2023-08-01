<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request){

        $items = Item::when($request->has('keyword'),function($query){
            $keyword = request()->keyword;
            $query->where('name','like',"%$keyword%")
                  ->orWhere('price','like',"%$keyword")
                  ->orWhere('stock','=',"$keyword");
        })->when($request->has('name'),function ($query){
            $sort = request()->name;
            $query->orderBy("name",$sort);
        })
            ->paginate(8)->withQueryString();

        return view('inventory.index',compact('items'));
    }
    public function show($id){
        return view('inventory.show',['item'=>Item::findOrFail($id)]);
    }
    public function edit($id){
        return view('inventory.edit',['item'=>Item::findOrFail($id)]);
    }

    public function update($id,UpdateItemRequest $request)
    {
        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->update();
        return redirect()->route('inventory.index')->with('status','updated successfully');
    }
    public function create(){
        return view('inventory.create');
    }
    public function store(StoreItemRequest $request){
        $item = new Item();
//        $item->name = $request->name;
//        $item->price = $request->price;
//        $item->stock = $request->stock;
//        $item->save();
//        $request->validate([
//            'name'=>'required|min:3|max:50|unique:items,name',
//            'price'=>'required|numeric|gte:50',
//            'stock'=>'required|numeric|gt:3'
//        ]);
        $item = Item::create([
            "name"=>$request->name,
            "price"=>$request->price,
            "stock"=>$request->stock,
        ]);
        return redirect()->route('inventory.index')->with('status','created successfully');
    }
    public function destroy($id){
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('status','deleted successfully');
    }
}

