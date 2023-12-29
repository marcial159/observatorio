<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Http\Requests\StoreCareerRequest;
use App\Http\Requests\UpdateCareerRequest;
use App\Http\Resources\CareerResource;

class CareerController extends Controller
{
    public function list( Request $request )
    {
        $list = Career::select( 'id', 'program', 'name','acronym','faculty_id','shield', 'created_at', 'updated_at' )
                           ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                           //->program( $request->program )
                           ->name( $request->name )
                           //->acronym( $request->acronym )
                           ->paginate( $request->rows ? $request->rows : 5 );

        return CareerResource::collection( $list );
    }


    public function store( StoreCareerRequest $request )
    {
        return new CareerResource( Career::create( $request->all() ) );
    }


    public function show( Career $career )
    {
        return response()->json( $career );
    }


    public function update( UpdateCareerRequest $request, Career $career )
    {
        $career->update( $request->all() );
        return new CareerResource( $career );
    }


    public function destroy( Career $career )
    {
        $career->delete();
        return new CareerResource( $career );
    }

    
    public static function relation()
    {
        return Career::select( 'id as value', 'descripcion as label' )
                          ->where( 'activo' , 1 )
                          ->get();
    }


    public function resources()
    {
        return response()->json([
            'careers' => CareerController::relation(),
        ]);
    }
}