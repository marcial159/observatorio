<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use Spatie\Permission\Models\Role as Roles;
use App\Models\Role;
use App\Models\ModelHasRole;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    public function list( Request $request )
    {
        $list = Role::select( 'id', 'name', 'guard_name', 'created_at', 'updated_at' )
                    ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                    ->name( $request->name )
                    ->guard( $request->guard_name )
                    ->paginate( $request->rows ? $request->rows : 5 );

        return RoleResource::collection( $list );
    }

    public function store( StoreRoleRequest $request )
    {
        $role = Roles::create( $request->all() );
        $role->syncPermissions($request->permissions);
        return response()->json( $role , 200 );
    }

    public function show( Roles $role )
    {
        return response()->json([
            'role' => $role,
            'permissions' => $role->permissions,
        ]);
    }

    public function update( UpdateRoleRequest $request , Roles $role )
    {
        $role->update( $request->all() );
        $role->syncPermissions($request->permissions);
        $role->actual = ModelHasRole::where([['model_id',auth()->user()->id],['model_type','App\Models\User']])->first()->role_id;
        $role->created = date("d/m/Y", strtotime($role->created_at));
        $role->updated = date("d/m/Y", strtotime($role->updated_at));
        return response()->json( $role );
    }

    public function destroy( Role $role )
    {
        $role->delete();
        return response()->json( $role );
    }

    public static function relation()
    {
        return Role::select('name AS label','id AS value')
                   ->get();
    }
}
