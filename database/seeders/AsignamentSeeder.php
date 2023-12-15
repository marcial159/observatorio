<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asignament;

class AsignamentSeeder extends Seeder
{
    public function run()
    {
        Asignament::create([
            'career_id'      => '1',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '1',
            'headquarter_id' => '3',
            'local'          => 'F02L01',
        ]);
        Asignament::create([
            'career_id'      => '2',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '3',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '3',
            'headquarter_id' => '2',
            'local'          => 'F02L05',
        ]);
        Asignament::create([
            'career_id'      => '4',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '5',
            'headquarter_id' => '1',
            'local'          => 'SL02',
        ]);
        Asignament::create([
            'career_id'      => '6',
            'headquarter_id' => '4',
            'local'          => 'F01L02',
        ]);
        Asignament::create([
            'career_id'      => '7',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '7',
            'headquarter_id' => '3',
            'local'          => 'F02L01',
        ]);
        Asignament::create([
            'career_id'      => '8',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '9',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '10',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '11',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
        Asignament::create([
            'career_id'      => '12',
            'headquarter_id' => '1',
            'local'          => 'SL01',
        ]);
    }
}
