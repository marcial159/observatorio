<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;


class ItemController extends Controller
{
    public function list( Request $request )
    {
        
        $list = Item::select( 'id', 'name', 'description','type','status','created_at', 'updated_at' )
                           ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                           ->name( $request->name )
                           ->description( $request->description )
                           ->type( $request->type )
                           ->paginate( $request->rows ? $request->rows : 5 );

        return ItemResource::collection( $list );
    }


    public function store( StoreItemRequest $request )
    {
        return new ItemResource( Item::create( $request->all() ) );
    }


    public function show( Item $item )
    {
        return response()->json( $item ); 
    }


    public function update( UpdateItemRequest $request, Item $item )
    {
        $item->update( $request->all() );
        return new ItemResource( $item );
    }


    public function destroy( item $item )
    {
        $item->delete();
        return new ItemResource( $item );
    }

    
    public static function relation()
    {
        return Item::select( 'id as value', 'descripcion as label' )
                          ->where( 'activo' , 1 )
                          ->get();
    }


    public function resources()
    {
        return response()->json([
            'items' => ItemController::relation(),
        ]);
    }
}

