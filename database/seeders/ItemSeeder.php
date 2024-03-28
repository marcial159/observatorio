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
        Item::create([
            'name'       => 'Equipamento',
            'description'    => 'maquinas, equipos y herramientas de investigacion',
            'type' => 1,
            'status' => 1,
        ]);
        Item::create([
            'name'       => 'materiales e insumos',
            'description'    => 'comprende los diferentes bienes o instrumentos de laboratorio o de campo requeridos para el desarrollo del proyecto',
            'type' => 1,
            'status' => 0,
        ]);
        Item::create([
            'name'       => 'Servivios Diversos',
            'description'    => 'Servicios de capaciotacion, servicios para analisis especializados, otros servicios',
            'type' => 3,
            'status' => 1,
        ]);
        Item::create([
            'name'       => 'Monitoreo',
            'description'    => 'comprende egresos relacionados al monitoreo, seguimiento y supervision',
            'type' => 2,
            'status' => 1,
        ]);

    }
}
