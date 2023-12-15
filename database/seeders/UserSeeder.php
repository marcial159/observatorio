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
            'firstname' => 'Usuario',
            'lastname' => 'Test',
            'email' => 'test@test.com',
            'password' => Hash::make('test123123123')
        ]);
        $user->assignRole('Admin');
    }
}
