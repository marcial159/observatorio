<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'denomination' => 'Ordinario Principal',
        ]);
        Category::create([
            'denomination' => 'Ordinario Asociado',
        ]);
        Category::create([
            'denomination' => 'Ordinario Auxiliar',
        ]);
        Category::create([
            'denomination' => 'Extraordinario',
        ]);
        Category::create([
            'denomination' => 'Contratado',
        ]);
        Category::create([
            'denomination' => 'Externo',
        ]);
    }
}
