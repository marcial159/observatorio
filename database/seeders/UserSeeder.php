<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'type_id' => 1,
            'person_id' => 1,
            'firstname' => 'Marcial',
            'lastname' => 'Salazar',
            'email' => '121179@unamba.edu.pe',
            'password' => Hash::make('mar123456')
        ]);
        $user->assignRole('Admin');
    }
}
