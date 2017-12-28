<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'Root',
        	'display_name' => 'Root',
        	'description' => 'Rol asociado al administrador de la plataforma'
        ]);

        Role::create([
        	'name' => 'Manager',
        	'display_name' => 'Manager',
        	'description' => 'Rol asociado a los encargados de cada lineamiento en la plataforma'
        ]);

        Role::create([
        	'name' => 'Administrador',
        	'display_name' => 'Administrador',
        	'description' => 'Rol asociado al administrador municipal'
        ]);
    }
}
