<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        Announcement::create([
            'title' => 'Concurso de Inv. Docente 2023',
            'type_project_id'  => 1,
            'resolution' => 'Resolucion 001',
            'short' => 'Conv. Docente 2023',
            'status' => 1,
        ]);
        Announcement::create([
            'title' => 'Concurso de Tesis 2023',
            'type_project_id'  => 2,
            'resolution' => 'Resolucion 002',
            'short' => 'Conv. Tesis 2023',
            'status' => 1,
        ]);
    }
}
