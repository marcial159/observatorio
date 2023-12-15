<?php
namespace App\Helpers;
use App\Models\User;
use JWTAuth;
use Auth;
use Carbon\Carbon;

class Larabase
{
    // Almacenar archivo
    public static function storeFile( $file , $disk )
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename  = uniqid().'.'.$extension;
        \Storage::disk( $disk )->put( $filename , \File::get( $file ) );
        return $filename;
    }

    public static function token()
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        return $token;
    }

    public static function period( $date, $days, $months, $years )
    {
        if( $days || $months || $years )
        {
            $days = $days ? $days : 0;
            $months = $months ? $months : 0;
            $years = $years ? $years : 0;

            $new_date = ( new Carbon( $date ) )->addDay( $days );
            $new_date = $new_date->addMonth( $months );
            $new_date = $new_date->addYear( $years );
            
            return $new_date;
        }
        else
        {
            return null;
        }
    }
}