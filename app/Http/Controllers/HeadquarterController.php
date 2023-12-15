<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Headquarter;
use App\Http\Requests\StoreHeadquarterRequest;
use App\Http\Requests\UpdateHeadquarterRequest;
use App\Http\Resources\HeadquarterResource;

class HeadquarterController extends Controller
{
    public function list( Request $request )
    {
        $list = Headquarter::select( 'id', 'name', 'position', 'created_at', 'updated_at' )
                           ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                           ->name( $request->name )
                           ->position( $request->position )
                           ->paginate( $request->rows ? $request->rows : 5 );

        return HeadquarterResource::collection( $list );
    }


    public function store( StoreHeadquarterRequest $request )
    {
        return new HeadquarterResource( Headquarter::create( $request->all() ) );
    }


    public function show( Headquarter $headquarter )
    {
        return response()->json( $headquarter );
    }


    public function update( UpdateHeadquarterRequest $request, Headquarter $headquarter )
    {
        $headquarter->update( $request->all() );
        return new HeadquarterResource( $headquarter );
    }


    public function destroy( Headquarter $headquarter )
    {
        $headquarter->delete();
        return new HeadquarterResource( $headquarter );
    }

    
    public static function relation()
    {
        return Headquarter::select( 'id as value', 'descripcion as label' )
                          ->where( 'activo' , 1 )
                          ->get();
    }


    public function resources()
    {
        return response()->json([
            'headquarters' => HeadquarterController::relation(),
        ]);
    }
}
