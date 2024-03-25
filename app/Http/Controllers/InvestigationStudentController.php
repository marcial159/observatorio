<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestigationStudent;
use App\Http\Requests\StoreInvestigationStudentRequest;
use App\Http\Requests\UpdateInvestigationStudentRequest;
use App\Http\Resources\InvestigationStudentResource;

class InvestigationStudentController extends Controller
{
    public function list( Request $request )
    {
        $list = InvestigationStudent::select( 'id', 'investigation_id', 'student_id','created_at', 'updated_at' )
                           ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                           //->program( $request->program )
                           ->student( $request->student_id )
                           //->acronym( $request->acronym )
                           ->paginate( $request->rows ? $request->rows : 5 );

        return InvestigationStudentResource::collection( $list );
    }


    public function store( StoreInvestigationStudentRequest $request )
    {
        return new InvestigationStudentResource( InvestigationStudent::create( $request->all() ) );
    }


    public function show( InvestigationStudent $investigation_student )
    {
        return response()->json( $investigation_student );
    }


    public function update( UpdateInvestigationStudentRequest $request, InvestigationStudent $investigation_student )
    {
        $investigation_student->update( $request->all() );
        return new InvestigationStudentResource( $investigation_student );
    }


    public function destroy( InvestigationStudent $investigation_student )
    {
        $investigation_student->delete();
        return new InvestigationStudentResource( $investigation_student );
    }

    
    public static function relation()
    {
        return InvestigationStudent::select( 'id as value', 'descripcion as label' )
                          ->where( 'activo' , 1 )
                          ->get();
    }


    public function resources()
    {
        return response()->json([
            'investigation_students' => InvestigationStudentController::relation(),
        ]);
    }
}