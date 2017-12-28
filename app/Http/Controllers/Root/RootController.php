<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserEditFormRequest;
use App\User;
use App\Role;
use App\Lineamiento;
use DB;

class RootController extends Controller
{
    public function home()
    {
    	return view('Root.index');
    }

    public function lineamientos()
    {
        $lineamientos = Lineamiento::all();

        $users = User::all();

        return view('Root.Lineamientos.index', compact('lineamientos', 'users'));
    }

    public function users()
    {
    	$users = User::all();

    	$roles = Role::all();

    	$selectedRoles = DB::table('role_user')->get();  

    	return view('Root.Users.index', compact('users', 'roles','selectedRoles'));
    }

    public function createUsers()
    {
    	return view('Root.Users.register');
    }

    public function storeUsers(UserFormRequest $request)
    {
        $sameUser = User::where('email',$request->get('email'))->first();
        if($sameUser){
            return view('Root.Users.register')->withErrors('El email ingresado ya existe');
        }

        $user = new User(array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ));

        $user->save();

        return redirect('root/usuarios/registrar')->with('status', 'Un nuevo usuario a sido creado!');
    }

    public function editUsers($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $roles = Role::all();
        $selectedRoles = $user->roles->lists('id')->toArray();

        return view('Root.Users.edit', compact('user', 'roles', 'selectedRoles'));
    }

    public function updateUsers(UserEditFormRequest $request, $id)
    {
        $user = User::whereId($id)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $password = $request->get('password');

        if ($password != "") {
            $user->password = Hash::make($password);
        }

        $user->save();
        $user->saveRoles($request->get('role'));

        return redirect(action('Root\RootController@editUsers', $user->id))->with('status', 'The user has been updated!');    
    }

    public function destroyUsers($id)
    {
        $user = User::whereId($id)->first();

        $user->delete();

        return redirect('root/usuarios')->with('status', 'Se ha eliminado a un usuario');
    }
}
