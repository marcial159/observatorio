<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'person_id' => 2,
            'code' => '111189',
            'asignament_id' => 5
        ]);

        Student::create([
            'person_id' => 3,
            'code' => '111190',
            'asignament_id' => 4
        ]);
    }
}
