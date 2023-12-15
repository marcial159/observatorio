<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Impact;

class ImpactSeeder extends Seeder
{
    public function run()
    {
        Impact::create([
            'title' => 'Internacional',
        ]);
        Impact::create([
            'title' => 'Nacional',
        ]);
        Impact::create([
            'title' => 'Regional',
        ]);
        Impact::create([
            'title' => 'Distrital',
        ]);
        Impact::create([
            'title' => 'Local',
        ]);
    }
}
