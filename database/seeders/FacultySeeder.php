<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run()
    {
        Faculty::create([
           'name' => 'Administración',
           'acronym' => 'FA',
       ]);
       Faculty::create([
          'name' => 'Educación y Ciencias Sociales',
          'acronym' => 'FECS',
      ]);
        Faculty::create([
       	'name' => 'Ingenierias',
       	'acronym' => 'FI',
       ]);
        Faculty::create([
       	'name' => 'Medicina Veterinaria',
       	'acronym' => 'FMV',
       ]);
       Faculty::create([
        'name' => 'Escuela de Postgrado',
        'acronym' => 'EP',
    ]);
    }
}
