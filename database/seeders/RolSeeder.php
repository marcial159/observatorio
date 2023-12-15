<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $docente = Role::create(['name' => 'Docente']);

        //Permisos para Roles
        Permission::create(['name' => 'role.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'role.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'role.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'role.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'role.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'role.destroy'])->syncRoles([$admin]);

    	//Permisos para Usuarios
        Permission::create(['name' => 'user.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.asignation'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.destroy'])->syncRoles([$admin]);

        //Permisos para Sedes
        Permission::create(['name' => 'headquarter.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'headquarter.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'headquarter.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'headqueater.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'headqueater.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'headquarter.destroy'])->syncRoles([$admin]);

        //Permisos para Facultades
        Permission::create(['name' => 'faculty.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'faculty.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'faculty.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'faculty.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'faculty.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'faculty.destroy'])->syncRoles([$admin]);

        //Permisos para Carreras
        Permission::create(['name' => 'career.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'career.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'career.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'caree.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'caree.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'career.destroy'])->syncRoles([$admin]);

        //Permisos para Laboratorios
        Permission::create(['name' => 'laboratory.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'laboratory.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'laboratory.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'laboratory.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'laboratory.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'laboratory.destroy'])->syncRoles([$admin]);

        //Permisos para Convocatorias
        Permission::create(['name' => 'announcement.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'announcement.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'announcement.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'announcement.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'announcement.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'announcement.destroy'])->syncRoles([$admin]);

        //Permisos para Lineas de Inv.
        Permission::create(['name' => 'line.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'line.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'line.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'line.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'line.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'line.destroy'])->syncRoles([$admin]);

        //Permisos para Procesos
        Permission::create(['name' => 'process.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'process.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'process.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'process.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'process.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'process.destroy'])->syncRoles([$admin]);

        //Permisos para Docentes
        Permission::create(['name' => 'lecturer.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'lecturer.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'lecturer.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'lecturer.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'lecturer.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'lecturer.destroy'])->syncRoles([$admin]);

        //Permisos para Estudiantes
        Permission::create(['name' => 'student.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'student.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'student.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'student.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'student.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'student.destroy'])->syncRoles([$admin]);

        //Permisos para Tesis
        Permission::create(['name' => 'undergraduate.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.asignation'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.process'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.upload'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.email'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.destroy'])->syncRoles([$admin]);
        Permission::create(['name' => 'undergraduate.analytic'])->syncRoles([$admin]);

        //Permisos para Inv. Docentes
        Permission::create(['name' => 'investigation.list'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.asignation'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.process'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.upload'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.pdf'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.excel'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.email'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.destroy'])->syncRoles([$admin]);
        Permission::create(['name' => 'investigation.analytic'])->syncRoles([$admin]);
    }
}
