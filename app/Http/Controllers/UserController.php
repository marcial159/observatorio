<?php
namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRecover;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserLogin;
use App\Http\Requests\UserAuthenticate;
use App\Http\Requests\UserReset;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRepassword;
use App\Mail\UserPasswordReset;
use App\Mail\UserPasswordNew;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\ModelHasRole;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Http;
use App\Models\Participation;
use Carbon\Carbon;
use JWTAuth;
use Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function list( Request $request )
    {
        $list = User::select( 'users.id', 'persons.id AS person_id', 'persons.gender', 'persons.document', 'users.avatar', 'users.firstname', 'users.lastname', 'model_has_roles.role_id as role_id', 'users.email', 'persons.phone', 'users.created_at', 'users.updated_at' )
                    ->join('persons','users.person_id','persons.id')
                    ->leftJoin('model_has_roles','users.id','model_has_roles.model_id')
                    ->orderBy( $request->parameter ? $request->parameter : 'id', $request->order ? $request->order : 'desc' )
                    ->name( $request->name )
                    ->type( $request->type )
                    ->email( $request->email )
                    ->paginate( ($request->rows) ? $request->rows : 5 );

        return UserResource::collection( $list );
    }

    public function store( StoreUserRequest $request )
    {
        $person = Person::where('document',$request->document)->first();
        if( $person )
        {
            $user = User::where('person_id',$person->id)->first();
            if($user)
            {
                return response()->json([
                    'message' => 'Usuario ya existente',
                    'errors' => [
                        'document' => 'Usuario ya existente'
                    ]
                ],422);
            }
            else
            {
                $request->validate([
                    'document' => 'bail|required|numeric||digits:8|unique:persons,document,'.$person->id,
                    'firstname' => 'bail|required|string|max:50',
                    'lastname' => 'bail|required|string|max:50',
                    'email' => 'bail|required|email|max:100|unique:persons,email,'.$person->id,
                    'phone' => 'bail|required|string|min:9|max:30|unique:persons,phone,'.$person->id,
                    'gender' => 'bail|required|in:M,F',            
                    'role_id' => 'bail|required|numeric'
                ]);

                $person->update( $request->all() );
                $code = rand( 100000, 999999 );
                $request['password'] = Hash::make( $code );
                $request['person_id'] = $person->id;
                $user = User::create( $request->all() );
                $user->assignRole($request->role_id);
                Mail::to( $user->email )->send(new UserPasswordNew( $user, $code ));
                return response()->json( $user, 200 );        
            }    
        }
        else
        {
            $request->validate([
                'document' => 'bail|required|numeric||digits:8|unique:persons,document',
                'firstname' => 'bail|required|string|max:50',
                'lastname' => 'bail|required|string|max:50',
                'email' => 'bail|required|email|max:100|unique:persons,email',
                'phone' => 'bail|required|string|min:9|max:30|unique:persons,phone',
                'gender' => 'bail|required|in:M,F',            
                'role_id' => 'bail|required|numeric'
            ]);

            $person = Person::create( $request->all() );
            $code = rand( 100000, 999999 );
            $request['password'] = Hash::make( $code );
            $request['person_id'] = $person->id;
            $user = User::create( $request->all() );
            $user->assignRole($request->role_id);
            Mail::to( $user->email )->send(new UserPasswordNew( $user, $code ));
            return response()->json( $user, 200 );
        }        
    }

    public function show( User $user )
    {
        $person = Person::where('id',$user->person_id)->firstOrFail();
        $role = ModelHasRole::where([['model_type','App\Models\User'],['model_id',$user->id]])->firstOrFail();
        return response()->json([
            'user' => $user,
            'person' => $person,
            'role' => $role,
        ]);
    }

    public function update( UpdateUserRequest $request , User $user )
    {
        $person = Person::where('id',$user->person_id)->first();
        $role = ModelHasRole::where([['model_type','App\Models\User'],['model_id',$user->id]])->firstOrFail();

        $usersWithIqualsEmail = User::where([['email',$request->email],['person_id','!=',$person->id]])->first();
        $personWithIqualsEmail = Person::where([['email',$request->email],['id','!=',$person->id]])->first();
        if( !$usersWithIqualsEmail && !$personWithIqualsEmail )
        {
            $person->update( $request->all() );
            $user->update( $request->all() );
            $modelHasRole = ModelHasRole::where([['model_type','App\Models\User'],['model_id',$user->id]])->firstOrFail();
            $modelHasRole->update([
                'role_id' => $request->role_id
            ]);
            $role = Role::findOrFail($request->role_id);
            
            return response()->json([
                'id' => $user->id,
                'person_id' => $person->id,
                'gender' => $person->gender,
                'document' => $person->document,
                'avatar' => $user->avatar,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'role' => [$role],
                'email' => $user->email,
                'phone' => $person->phone,
                'created_at' => date("d/m/Y", strtotime($user->created_at)),
                'updated_at' => date("d/m/Y", strtotime($user->updated_at)),

            ]);
        }
        else
        {
            return response()->json([
                'message' => 'Correo empleado para otro usuario',
                'errors' => [
                    'email' => 'Correo empleado para otro usuario'
                ]
            ],422);    
        }
    }

    public function destroy( User $user )
    {
        $user->delete();
        return response()->json( $user, 200 );
    }

    public function search( $document )
    {
        $user = User::where('document',$document)->first();
        return response()->json(compact('user'),200);
    }

    public function find( Request $request ){
        $user = User::selectRaw('id, CONCAT(firstname," ",lastname) as text')
                    ->whereRaw('CONCAT(firstname," ", lastname) LIKE "%'.$request->term.'%" AND type = 1')
                    ->get();
        return ['results' => $user];
    }


    public function login( UserLogin $request )
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = User::where([['type_id',1],['email',$request->email]])->first();
            $model = ModelHasRole::where('model_id',$user->id)->first();
            $role = Role::where('id',$model->role_id)->first();
            if($role)
            {
                try
                {
                    if (! $token = JWTAuth::fromUser($user))
                    {
                        return response()->json(['error' => 'invalid_credentials'], 401);
                    }
                }
                catch (JWTException $e)
                {
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }
                return response()->json([
                    'avatar' => $user->avatar,
                    'firstname' => $user->firstname,
                    'email' => $user->email,
                    'role' => $role,
                    'type' => $user->types,
                    'permissions' => $user->getPermissionsViaRoles(),
                    'token' => $token,
                ]);
            }
            else
            {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        }
        else
        {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
    }

    public function loginWithGoogle( Request $request )
    {
        $user = User::where([['type_id',1],['email',$request->email]])->firstOrFail();
        
        if(!$user->avatar)
        $user->update(['avatar' => $request->avatar]);

        $model = ModelHasRole::where('model_id',$user->id)->firstOrFail();
        $role = Role::where('id',$model->role_id)->firstOrFail();
        try
        {
            if(!$token = JWTAuth::fromUser($user))
            {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        }
        catch (JWTException $e)
        {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json([
            'firstname' => $user->firstname,
            'email' => $user->email,
            'role' => $role,
            'type' => $user->types,
            'permissions' => $user->getPermissionsViaRoles(),
            'token' => $token,
        ]);
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function recover( UserRecover $request )
    {
        $user = User::where( 'email' , $request->email )->first();
        if(!$user){
            return response()->json([
                'status'  => 'Error',
                'message' => 'Usuario no encontrado',
            ], 404);
        }
        PasswordReset::where( 'email' , $request->email )->where( 'type' , $request->type )->delete();
        $reset = PasswordReset::create([
            'email' => $user->email,
            'type'  => $user->type,
            'token' => rand(1000, 9999),
        ]);
        Mail::to($user->email)->send(new UserPasswordReset( $user , $reset->token ));
        return response()->json([
            'status'  => 'success',
            'message' => 'Mensaje enviado',
        ], 200);
    }

    public function reset( UserReset $request )
    {
        $reset = PasswordReset::where( 'token' , $request->token )->where( 'type' , $request->type )->where( 'email' , $request->email )->first();
        $user = User::where( 'email' , $request->email )->first();
        if ( $reset && $user ) {
            PasswordReset::where( 'email' , $reset->email )->where( 'type' , $request->type )->delete();
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'status'  => 'success',
                'message' => 'Contraseña restablecida correctamente.',
            ], 200);
        }
        return response()->json([
            'status'  => 'Error',
            'message' => 'El token es incorrecto o ha expirado.',
        ], 404);
    }

    public function repassword( UserRepassword $request )
    {
        $user = User::where([['type',1],['email',$request->email]])->first();
        // return $user;
        if ($user)
        {
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'status'  => 'success',
                'user' => $user,
                'message' => 'Contraseña restablecida correctamente.',
            ], 200);
        }
        return response()->json([
            'status'  => 'Error',
            'message' => 'El token es incorrecto o ha expirado.',
        ], 404);
    }

    public function resources()
    {
        return response()->json([
            'roles' => RoleController::relation()
        ]);
    }
}
