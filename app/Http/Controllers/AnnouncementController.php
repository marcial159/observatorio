<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Http\Resources\AnnouncementResource;

class AnnouncementController extends Controller
{
    public function list( Request $request )
    {
        $list = Announcement::select( 'id', 'title', 'type_project_id','resolution','short','status' )
                           ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                           //->program( $request->program )
                           ->title( $request->title )
                           //->type_project( $request->type_project)
                           ->paginate( $request->rows ? $request->rows : 5 );

        return AnnouncementResource::collection( $list );
    }


    public function store( StoreAnnouncementRequest $request )
    {
        return new AnnouncementResource( Announcement::create( $request->all() ) );
    }


    public function show( Announcement $announcement )
    {
        return response()->json( $announcement );
    }


    public function update( UpdateAnnouncementRequest $request, Announcement $announcement )
    {
        $announcement->update( $request->all() );
        return new AnnouncementResource( $announcement );
    }


    public function destroy( Announcement $announcement )
    {
        $announcement->delete();
        return new AnnouncementResource( $announcement );
    }

    
    public static function relation()
    {
        return Announcement::select( 'id as value', 'descripcion as label' )
                          ->where( 'activo' , 1 )
                          ->get();
    }


    public function resources()
    {
        return response()->json([
            'announcements' => AnnouncementController::relation(),
        ]);
    }
}