<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run()
    {
        Career::create([
            'program'    => 'P01',
            'name'       => 'Administración',
            'acronym'    => 'AE',
            'faculty_id' => '1',
        ]);
        Career::create([
            'program'    => 'P02',
            'name'       => 'Ingeniería Agroindustrial',
            'acronym'    => 'IA',
            'faculty_id' => '3',
        ]);
        Career::create([
            'program'    => 'P03',
            'name'       => 'Ingeniería de Minas',
            'acronym'    => 'IM',
            'faculty_id' => '3',
        ]);
        Career::create([
            'program'    => 'P04',
            'name'       => 'Ingeniería Informática y Sistemas',
            'acronym'    => 'IIS',
            'faculty_id' => '3',
        ]);
        Career::create([
            'program'    => 'P05',
            'name'       => 'Medicina Veterinaria y Zootécnia',
            'acronym'    => 'MVZ',
            'faculty_id' => '4',
        ]);
        Career::create([
            'program'    => 'P06',
            'name'       => 'Ingeniería Agroecológica y Desarrollo Rural',
            'acronym'    => 'IADR',
            'faculty_id' => '3',
        ]);
        Career::create([
            'program'    => 'P07',
            'name'       => 'Ingeniería Civil',
            'acronym'    => 'IC',
            'faculty_id' => '3',
        ]);
        Career::create([
            'program'    => 'P08',
            'name'       => 'Educación Inicial Intercultural Bilingue',
            'acronym'    => 'EIIB',
            'faculty_id' => '2',
        ]);
        Career::create([
            'program'    => 'P09',
            'name'       => 'Ciencias Políticas y Gobernabilidad',
            'acronym'    => 'CPG',
            'faculty_id' => '2',
        ]);
        Career::create([
            'program'    => 'P10',
            'name'       => 'Maestria en Educacion',
            'acronym'    => 'ME',
            'faculty_id' => '2',
        ]);
        Career::create([
            'program'    => 'P11',
            'name'       => 'Departamento Académico de Humanidades',
            'acronym'    => 'DAH',
            'faculty_id' => '2',
        ]);
        Career::create([
            'program'    => 'P12',
            'name'       => 'Departamento Académico de Ciencias Básicas',
            'acronym'    => 'DACB',
            'faculty_id' => '2',
        ]);
    }
}
