<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lecturer;

class LecturerSeeder extends Seeder
{
    public function run()
    {
        Lecturer::create([
            'person_id' => 2,
            'grade' => 'Ing',
            'category_id' => 1,
            'asignament_id' => 5,
            'renacyt' => 'text.com'
        ]);

        Lecturer::create([
            'person_id' => 3,
            'grade' => 'Ing',
            'category_id' => 1,
            'asignament_id' => 4,
            'renacyt' => 'text.com'
        ]);
    }
}
