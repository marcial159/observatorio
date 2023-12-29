<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;
use App\Http\Resources\FacultyResource;

class FacultyController extends Controller
{
    public function list( Request $request )
    {
        $list = Faculty::select( 'id', 'name', 'acronym', 'created_at', 'updated_at' )
                           ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                           ->name( $request->name )
                           ->acronym( $request->acronym )
                           ->paginate( $request->rows ? $request->rows : 5 );

        return FacultyResource::collection( $list );
    }


    public function store( StoreFacultyRequest $request )
    {
        return new FacultyResource( Faculty::create( $request->all() ) );
    }


    public function show( Faculty $faculty )
    {
        return response()->json( $faculty );
    }


    public function update( UpdateFacultyRequest $request, Faculty $faculty )
    {
        $faculty->update( $request->all() );
        return new FacultyResource( $faculty );
    }


    public function destroy( Faculty $faculty )
    {
        $faculty->delete();
        return new FacultyResource( $faculty );
    }

    
    public static function relation()
    {
        return Faculty::select( 'id as value', 'descripcion as label' )
                          ->where( 'activo' , 1 )
                          ->get();
    }


    public function resources()
    {
        return response()->json([
            'faculties' => FacultyController::relation(),
        ]);
    }
}
