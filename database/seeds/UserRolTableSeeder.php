<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Role_User;
use App\User;

class UserRolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('name', 'Jorge Almonacid')->first();
        $rol =  Role::where('name', 'Root')->first();

        Role_user::create([
        	'user_id' => $user->id,
        	'role_id' => $rol->id
        ]);
    }
}
