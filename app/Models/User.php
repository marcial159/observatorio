<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'type_id',
        'person_id',
        'avatar',
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $with = [ 'types', 'role' ];

    public function role()
    {
        return $this->belongsToMany( 'App\Models\Role', 'model_has_roles', 'model_id', 'role_id' );
    }

    public function getCreatedAtAttribute( $value )
    {
        return date("d-m-Y", strtotime( $value ));
    }

    public function getUpdatedAtAttribute( $value )
    {
        return date("d-m-Y", strtotime( $value ));
    }

    public function types() {
        return $this->hasMany( 'App\Models\Type', 'id', 'type' );
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function scopeName( $query, $name )
    {
        if( $name )
        return $query->whereRaw( 'concat(users.firstname," ",users.lastname) like "%'.$name.'%"' );
    }

    public function scopeType( $query, $type )
    {
        if( $type )
        return $query->where( 'type', 'LIKE', "%".$type."%" );
    }

    public function scopeEmail( $query, $email )
    {
        if( $email )
        return $query->where( 'users.email', 'LIKE', "%".$email."%" );
    }
}
