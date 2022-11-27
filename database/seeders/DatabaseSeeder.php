<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (array('Admin' , 'User') as $key => $role) {
            Role::create( [ 'name' => $role ] );
        }

        $active = \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::Status,
            'description' => "Activo"
        ]);

        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::Status,
            'description' => "Inactivo"
        ]);

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'gpid' => '12345678',
            'role_id' => \App\Models\Role::Admin,
            'is_active' => $active->id,
            'password' => bcrypt("123456")
        ]);
    }
}
