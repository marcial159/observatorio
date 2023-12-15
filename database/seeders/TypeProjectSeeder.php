<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeProject;

class TypeProjectSeeder extends Seeder
{
    public function run()
    {
        TypeProject::create([
            'title' => 'Investigaciones doncentes financiadas con fondos CANON',
            'short_title' => 'Inv. docente',
        ]);

        TypeProject::create([
            'title' => 'Tesis de pregrado financiadas con fondos CANON',
            'short_title' => 'Tesis de pregrado',
        ]);
    }
}
