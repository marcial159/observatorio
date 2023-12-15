<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Line;

class LineSeeder extends Seeder
{
    public function run()
    {
        Line::create([
            'title' => 'Gestión Empresarial',
            'career_id' => '1',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Gestión Pública',
            'career_id' => '1',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Caracterización, desarrollo de procesos e innovación en la agroindustria',
            'career_id' => '2',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Minería y procesamiento de minerales',
            'career_id' => '3',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Geología, geotecnia y medio ambiente',
            'career_id' => '3',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Ingeniería informática, industria y sociedad',
            'career_id' => '4',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Ingeniería de software e innovación tecnológica',
            'career_id' => '4',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Ciencias Veterinarias',
            'career_id' => '5',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Recursos hídricos,agricultura, silvicultura y pecuaria sostenible',
            'career_id' => '6',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Biotecnología, fitomejoramiento y conservación de la Biodiversidad',
            'career_id' => '6',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Ingeniería de la Construcción',
            'career_id' => '7',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Ingeniería de materiales',
            'career_id' => '7',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Educación Inicial, desarrollo infantil y gestión pedagógica',
            'career_id' => '8',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Interculturalidad y Cosmovisión Andina',
            'career_id' => '8',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Sistema Político y gobernabilidad',
            'career_id' => '9',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Teoría política y globalizacion',
            'career_id' => '9',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Modelo de gestión y calidad educativa',
            'career_id' => '10',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Desarrollo humano y calidad de vida',
            'career_id' => '11',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Sociedad e identidad nacional, territorios y cambios climáticos',
            'career_id' => '11',
            'status' => '1',
            'category' => '1'
        ]);
        Line::create([
            'title' => 'Aplicación de la matemática, estadística, física, química y biología',
            'career_id' => '12',
            'status' => '1',
            'category' => '1'
        ]);
    }
}
