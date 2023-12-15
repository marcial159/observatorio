<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Process;

class ProcessSeeder extends Seeder
{
    public function run()
    {
        Process::create([
            'title'  => 'Proceso de Inv. Docente 2023 - I',
            'type_project_id' => 1,
            'status' => 1,
            'maxy' => 1,
            'maxm' => 0,
            'maxd' => 0,
            'miny' => 0,
            'minm' => 6,
            'mind' => 0,
            ]);
        Process::create([
            'title'  => 'Proceso de Tesis 2023 - I',
            'type_project_id' => 2,
            'status' => 1,
            'maxy' => 1,
            'maxm' => 0,
            'maxd' => 0,
            'miny' => 0,
            'minm' => 6,
            'mind' => 0,
        ]);
    }
}
