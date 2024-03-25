<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$items = [
            [
                'name' => 'Materiales e insumos',
                'description' => 'Materiales e insumos para las actividades del proyecto.',
            ],
            [
                'name' => 'Consultorías y/o mentorías especializadas',
                'description' => 'Asesorías individuales o de empresas y asistencia administrativa designada por el VRIN.',
            ],
            [
                'name' => 'Servicios tecnológicos y empresariales',
                'description' => 'Servicios tecnológicos y empresariales necesarios para el proyecto.',
            ],
            [
                'name' => 'Pasajes y viáticos',
                'description' => 'Pasajes y viáticos para trabajo de campo y capacitación, eventos de networking y participación en programas de incubación o aceleración.',
            ],
            [
                'name' => 'Otros gastos',
                'description' => 'Material bibliográfico y bases de datos especializadas.',
            ],
            [
                'name' => 'Gastos de Gestión',
                'description' => 'Gastos relacionados con la gestión y administración del proyecto.',
            ],
            [
                'name' => 'Equipos y bienes duraderos',
                'description' => 'Equipos menores relacionados al desarrollo del proyecto. Los equipos y bienes duraderos serán comprados a nombre de la universidad.',
            ],
        ];*/
        Item::create([
            'name'    => 'Equipamento',
            'description'  => 'Equipo relacionado a la investigacion',
            'type'    => '2',
            'status' => '1',
        ]);
        Item::create([
            'name'    => 'Equipos y bienes duraderos',
            'description'  => 'Equipos menores relacionados al desarrollo del proyecto. Los equipos y bienes duraderos serán comprados a nombre de la universidad.',
            'type'    => '3',
            'status' => '1',
        ]);

    }
}
