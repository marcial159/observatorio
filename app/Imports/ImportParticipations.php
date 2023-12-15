<?php
namespace App\Imports;
use App\Models\User;
use App\Models\Participation;
use App\Helpers\RegionBase;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Luecano\NumeroALetras\NumeroALetras;

class ImportParticipations implements ToCollection, WithHeadingRow
{
    public function  __construct($id)
    {
        $this->id = $id;
    }

    public function collection(Collection $rows)
    {
        $formatter = new NumeroALetras();
        foreach ($rows as $row)
        {
            $user = User::where('document', $row['dni'])->first();
            if( $user )
            {
                $relation = Participation::where([['user',$user->id],['event',$this->id]])->first();
                if(!$relation)
                {
                    Participation::create([
                        'event'    => $this->id,
                        'user'     => $user->id,
                        'code'     => ($row['codigo']) ? $row['codigo'] : uniqid(),
                        'note'     => ($row['nota']) ? $row['nota'] : null,
                        'textnote' => ($row['nota']) ? ucfirst( mb_strtolower($formatter->toWords($row['nota']),'UTF-8')) : null,
                    ]);
                }
            }
            else
            {
                $row['dni'] = (string)$row['dni'];
                $row['celular'] = (string)$row['celular'];
                Validator::make($row->toArray(),
                [
                    'dni'  => 'bail|required|string|min:8|max:20|unique:users,document',
                    'nombres' => 'bail|required|string|max:50',
                    'apellidos'  => 'bail|required|string|max:50',
                    'celular'     => 'bail|nullable|string|min:9|max:30|unique:users,phone',
                    'email'     => 'bail|required|email|max:100|unique:users,email',
                    'region'    => 'bail|nullable',
                ],
                [
                    'dni.required' => 'Se encontró un registro sin cédula ó documento de identidad.',
                    'nombres.required' => 'Se encontró un registro sin nombre(s).',
                    'apellidos.required' => 'Se encontró un registro sin apellidos.',
                    'email.required' => 'Se encontró un registro sin email.',

                    'nombres.string' => 'Se encontró un registro con un nombre no alfabético.',
                    'apellidos.string' => 'Se encontró un registro con un apellido no alfabético.',

                    'email.email' => 'El registro del estudiante: '.$row['nombres'].' '.$row['apellidos'].' cuenta con un correo con formato inválido',

                    'dni.min' => 'La cédula ó documento de identidad del estudiante: '.$row['nombres'].' '.$row['apellidos'].' no cuenta con el minimo de caracteres requerido.',
                    'celular.min' => 'La celular del estudiante: '.$row['nombres'].' '.$row['apellidos'].' no cuenta con el minimo de caracteres requerido.',

                    'dni.max' => 'La cédula ó documento de identidad del estudiante: '.$row['nombres'].' '.$row['apellidos'].' excede la cantidad de caracteres.',
                    'nombres.max' => 'El nombre del estudiante : '.$row['nombres'].' '.$row['apellidos'].' excede la cantidad de caracteres.',
                    'apellidos.max' => 'Los apellidos del estudiante : '.$row['nombres'].' '.$row['apellidos'].' excede la cantidad de caracteres.',
                    'celular.max' => 'La celular del estudiante : '.$row['nombres'].' '.$row['apellidos'].' excede la cantidad de caracteres.',
                    'email.max' => 'La email del estudiante : '.$row['nombres'].' '.$row['apellidos'].' excede la cantidad de caracteres.',

                    'dni.unique' => 'La cédula ó documento de identidad del estudiante '.$row['dni'].' ya está en uso.',
                    'celular.unique' => 'La número de celular '.$row['celular'].' ya está en uso.',
                    'email.unique' => 'El email '.$row['email'].' ya está en uso.',
                ])->validate();

                $user = User::create([
                    'type' => 2,
                    'document' => $row['dni'],
                    'firstname' => $row['nombres'],
                    'lastname' => $row['apellidos'],
                    'phone' => $row['celular'],
                    'email' => $row['email'],
                    'region' => ($row['region']) ? RegionBase::getId($row['region']) : null,
                ]);

                Participation::create([
                    'event'       => $this->id,
                    'user'        => $user->id,
                    'code'        => ($row['codigo']) ? $row['codigo'] : uniqid(),
                    'note'        => ($row['nota']) ? $row['nota'] : null,
                    'textnote'    => ($row['nota']) ? ucfirst( mb_strtolower($formatter->toWords($row['nota']),'UTF-8')) : null,
                ]);
            }
        }

    }
}
