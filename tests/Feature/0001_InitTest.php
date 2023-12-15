<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\PersonSeeder;
use Database\Seeders\HeadquarterSeeder;
use Database\Seeders\FacultySeeder;
use Database\Seeders\CareerSeeder;
use Database\Seeders\LineSeeder;
use Database\Seeders\TypeProjectSeeder;

use Database\Seeders\UserSeeder;
use Database\Seeders\LecturerSeeder;
use Database\Seeders\StudentSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class InitTest extends TestCase
{
    public function test_init()
    {
        Artisan::call('migrate:fresh');
        $this->seed([
            PersonSeeder::class,
            HeadquarterSeeder::class,
            FacultySeeder::class,
            CareerSeeder::class,
            LineSeeder::class,
            TypeProjectSeeder::class,
            // LecturerSeeder::class,
            // StudentSeeder::class,
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
