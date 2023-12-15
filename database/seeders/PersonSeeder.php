<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;

class PersonSeeder extends Seeder
{
    public function run()
    {
        Person::create([
            'document' => 74212133,
            'firstname' => 'Usuario',
            'lastname' => 'Test',
            'gender' => 1,
            'email' => 'test@test.com',
            'phone' => '931676824',
        ]);

        Person::create([
            'document' => 74212134,
            'firstname' => 'Eberth Alexis',
            'lastname' => 'Talavera Villavicencio',
            'gender' => 1,
            'email' => 'eberth123@gmail.com',
            'phone' => '931676825',
        ]);

        Person::create([
            'document' => 74212135,
            'firstname' => 'Jonathan Luis',
            'lastname' => 'Santisteban Mino',
            'gender' => 1,
            'email' => 'jonathan123@gmail.com',
            'phone' => '931676826',
        ]);
    }
}
