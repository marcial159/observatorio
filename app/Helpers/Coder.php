<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Models\Investigation;
use App\Models\Undergraduate;
use App\Models\Line;

class Coder
{    
    public static function generate( $type , $line )
    {

        $digits = 7;

        // Inicializacion del codigo
        $code = null;

        // Optener ultimos 2 digitos del año en curso
        $year = date( 'y' );

        // Linea de investigación
        $line = Line::findOrFail( $line );

        // Código de programa
        $program = substr( $line->career->program , 1 );

        // Subcódigo de 4 digitos
        $subcode = $year.str_pad( $program , 2 , '0' , STR_PAD_LEFT );

        // Digitos de correlativo
        $correlative = $digits - 4;
        
        if( $type == 1 )
        $last = Investigation::where( 'code', 'like', $subcode.'%' )->orderBy( 'investigations.code', 'desc' )->first();

        if( $type == 2 )
        $last = Undergraduate::where( 'code', 'like', $subcode.'%' )->orderBy( 'undergraduates.code', 'desc' )->first();

        // Validar existencia del código de la carrera
        if( $last )
        $code = $last->code + 1;
        else
        $code = $subcode.str_pad( 1, $correlative, '0', STR_PAD_LEFT );

        return $code;
    }
}