<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Headquarter;

class HeadquarterSeeder extends Seeder
{
    public function run()
    {
        Headquarter::create([
        	'name'     => 'Abancay',
            'position' => 'Abancay, Tamburco',
        ]);
        Headquarter::create([
        	'name'     => 'Haquira',
            'position' => 'Cotabambas, Haquira',
        ]);
        Headquarter::create([
        	'name'     => 'Tambobamba',
            'position' => 'Cotabambas, Tambobamba',
        ]);
        Headquarter::create([
        	'name'     => 'Vilcabamba',
            'position' => 'Grau, Vilcabamba',
        ]);
    }
}
