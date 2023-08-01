<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
//        $this->middleware('cat')->only(['store','destroy','index']);
//        $this->middleware('cat')->except('index');
//        $this->middleware('cat:meow');
    }


    public function index(Request $request)
    {
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
//        return response()->json($items,200);
        return ItemResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //     'stock' => 'required'
        // ]);
        $validator = Validator::make($request->all(),[
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required'
            ]);
            if($validator->fails()){
                return response()->json($validator->messages(),422);
            }
        $item = Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        if(!is_null($item)){
//             return response()->json($item,200);
            return new ItemResource($item);
            }
        return response()->json(['message'=>'404 not found',404]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->messages(),422);
        }

        $item = Item::find($id);
        if(is_null($item)){
            return response()->json(['message'=>'404 not found',404]);
        }

        $item->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return response()->json($item,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if(is_null($item)){
            return response()->json(['message'=>'404 not found',404]);
        }
        $item->delete();
        return response()->json(['message'=>'deleted successfully'],200);
    }
}
