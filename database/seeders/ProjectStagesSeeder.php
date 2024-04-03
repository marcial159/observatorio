<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectStage;

class ProjectStagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $stages = [
                [
                    'name' => 'Preincubación',
                    'description' => 'En esta etapa, se lleva a cabo la evaluación y selección de las ideas de negocio para determinar su viabilidad y potencial.',
                ],
                [
                    'name' => 'Incubación',
                    'description' => 'Durante la incubación, se brinda apoyo y asesoramiento a los emprendedores para desarrollar y hacer crecer sus empresas.',
                ],
                [
                    'name' => 'Posincubación',
                    'description' => 'En la etapa de posincubación, las empresas ya establecidas continúan recibiendo apoyo y orientación para consolidarse en el mercado.',
                ],
            ];
    
            foreach ($stages as $stage) {
                ProjectStage::create($stage);
            }
    }
}
