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
        // foreach (array('Admin' , 'User') as $key => $role) {
        //     Role::create( [ 'name' => $role ] );
        // }

        // $active = \App\Models\Parameter::create([
        //     'parent' => \App\Models\Parameter::Status,
        //     'description' => "Activo"
        // ]);

        // \App\Models\Parameter::create([
        //     'parent' => \App\Models\Parameter::Status,
        //     'description' => "Inactivo"
        // ]);

        // \App\Models\User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'gpid' => '12345678',
        //     'role_id' => \App\Models\Role::Admin,
        //     'is_active' => $active->id,
        //     'password' => bcrypt("123456")
        // ]);

        /* ========== opciones computo ==========*/
        // ======== Parameter::TypeComputer
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::TypeComputer,
            'description' => "DESKTOP"
        ]);

        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::TypeComputer,
            'description' => "LAPTOP"
        ]);

        // ======== Parameter::BrandComputer
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::BrandComputer,
            'description' => "LENOVO"
        ]);

        // ======== Parameter::ModelComputer
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::ModelComputer,
            'description' => "ThinkCentre M920s"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::ModelComputer,
            'description' => "ThinkPad X390"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::ModelComputer,
            'description' => "ThinkPad T490"
        ]);

        // ======== Parameter::SOComputer
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::SOComputer,
            'description' => "Microsoft Windows 10 Pro"
        ]);

        // ======== Parameter::StatusComputer
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::StatusComputer,
            'description' => "Perdido"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::StatusComputer,
            'description' => "Custodia IT"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::StatusComputer,
            'description' => "Dañado"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::StatusComputer,
            'description' => "Obsoleto"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::StatusComputer,
            'description' => "Robado"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::StatusComputer,
            'description' => "Prestado"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::StatusComputer,
            'description' => "Baja"
        ]);

        // ======== Parameter::SupplierComputer
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::SupplierComputer,
            'description' => "LAN TOTAL"
        ]);
        \App\Models\Parameter::create([
            'parent' => \App\Models\Parameter::SupplierComputer,
            'description' => "LENOVO"
        ]);

    }
}
