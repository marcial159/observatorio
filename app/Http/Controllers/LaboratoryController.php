<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laboratory;
use App\Http\Requests\StoreLaboratoryRequest;
use App\Http\Requests\UpdateLaboratoryRequest;
use App\Http\Resources\LaboratoryResource;

class LaboratoryController extends Controller
{
    public function list( Request $request )
    {
        $list = Laboratory::select( 'id', 'name', 'ambient','asignament_id','description', 'created_at', 'updated_at' )
                           ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                           ->name( $request->name )
                           ->ambient( $request->ambient )
                           ->asignament( $request->asignament_id)
                           ->paginate( $request->rows ? $request->rows : 5 );

        return LaboratoryResource::collection( $list );
    }


    public function store( StoreLaboratoryRequest $request )
    {
        return new LaboratoryResource( Laboratory::create( $request->all() ) );
    }


    public function show( Laboratory $laboratory )
    {
        return response()->json( $laboratory );
    }


    public function update( UpdateLaboratoryRequest $request, Laboratory $laboratory )
    {
        $laboratory->update( $request->all() );
        return new LaboratoryResource( $laboratory );
    }


    public function destroy( Laboratory $laboratory )
    {
        $laboratory->delete();
        return new LaboratoryResource( $laboratory );
    }

    
    public static function relation()
    {
        return Laboratory::select( 'id as value', 'descripcion as label' )
                          ->where( 'activo' , 1 )
                          ->get();
    }


    public function resources()
    {
        return response()->json([
            'laboratories' => LaboratoryController::relation(),
        ]);
    }
}
