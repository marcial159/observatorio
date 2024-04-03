<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;

class ProjectCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $categories = [
            [
                'name' => 'Categoría 1',
                'description' => 'Proyectos que buscan conceptualizar su propuesta de valor y/o encontrar un modelo de negocio innovador. Se admiten proyectos en todos los sectores.',
            ],
            [
                'name' => 'Categoría 2',
                'description' => 'Proyectos con innovación mínimamente viable ingresando al mercado. Se admiten proyectos en todos los sectores.',
            ]
        ];

        foreach ($categories as $category) {
            ProjectCategory::create($category);
        }
    }
}
