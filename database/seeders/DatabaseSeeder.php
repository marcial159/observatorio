<?php
namespace Database\Seeders;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('announcements')->truncate();
        DB::table('asignaments')->truncate();
        DB::table('careers')->truncate();
        DB::table('categorys')->truncate();
        DB::table('faculties')->truncate();
        DB::table('headquarters')->truncate();
        DB::table('impacts')->truncate();
        DB::table('laboratories')->truncate();
        DB::table('lecturers')->truncate();
        DB::table('lines')->truncate();
        DB::table('persons')->truncate();
        DB::table('process')->truncate();
        DB::table('roles')->truncate();
        DB::table('students')->truncate();
        DB::table('type_projects')->truncate();
        DB::table('types')->truncate();
        DB::table('users')->truncate();
        DB::table('permissions')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $this->call(TypeProjectSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(HeadquarterSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(CareerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AsignamentSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(LineSeeder::class);
        $this->call(ImpactSeeder::class);
        $this->call(LaboratorySeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(ProcessSeeder::class);
        $this->call(LecturerSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(UserSeeder::class);
    }
}
