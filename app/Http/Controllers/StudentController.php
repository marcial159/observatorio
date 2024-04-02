<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function list( Request $request )
    {
        $list = Student::select( 'id', 'person_id', 'code','asignament_id','created_at', 'updated_at' )
                           ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                           ->person_id( $request->person_id )
                           ->code( $request->code )
                           ->asignament_id( $request->asignament_id )
                           ->paginate( $request->rows ? $request->rows : 5 );

        return StudentResource::collection( $list );
    }


    public function store( StoreStudentRequest $request )
    {
        return new StudentResource( Student::create( $request->all() ) );
    }


    public function show( Student $student )
    {
        return response()->json( $student );
    }


    public function update( UpdateStudentRequest $request, Student $student )
    {
        $student->update( $request->all() );
        return new StudentResource( $student );
    }


    public function destroy( Student $student )
    {
        $student->delete();
        return new StudentResource( $student );
    }

    
    public static function relation()
    {
        return Student::select( 'id as value', 'descripcion as label' )
                          ->where( 'activo' , 1 )
                          ->get();
    }


    public function resources()
    {
        return response()->json([
            'students' => StudentController::relation(),
        ]);
    }
}