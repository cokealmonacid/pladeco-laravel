<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LineamientoFormRequest;
use App\Http\Controllers\Controller;
use App\Lineamiento;
use App\User;
use App\Role;
use DB;

class LineamientoController extends Controller
{
    public function createLineamientos()
    {
    	$users = User::all();

    	$roles = Role::where('name', 'Manager')->first();

    	$selectedRoles = DB::table('role_user')->where('role_id', $roles->id)->get();

    	return view('Root.Lineamientos.register', compact('users', 'selectedRoles', 'users'));
    }

    public function storeLineamientos(LineamientoFormRequest $request)
    {
    	$sameLineamiento = Lineamiento::where('name', $request->get('name'))->first();
    	if ($sameLineamiento) {
    		return redirect('root/lineamientos/registrar')->withErros('El lineamiento ya existe');
    	}

    	$lineamiento = new Lineamiento(array(
    		'name' => $request->get('name'),
    		'user_id' => implode("", $request->get('user'))
    	));

    	$lineamiento->save();

    	return redirect('root/lineamientos/registrar')->with('status', 'Lineamiento creado con éxito');
    }

    public function editLineamientos($id)
    {
        $lineamiento = Lineamiento::whereId($id)->firstOrFail();
        $users = User::all();

        return view('Root.Lineamientos.edit', compact('users', 'lineamiento'));
    }

    public function updateLineamientos(Request $request)
    {
        $count = Lineamiento::where('user_id', $request->get('user'))->count();
        if ($count > 1) {
         return redirect(action('Root\LineamientoController@editLineamientos', $lineamiento->id))->withErrors('No se puede asignar más de un lineamiento a un usuario');               
        }

        if ($count == 1) {
            $sameLineamiento = Lineamiento::where('name', $request->get('name'))->first();
            $lineamiento = Lineamiento::where('user_id', $request->get('user'))->first();
            if ($sameLineamiento->id != $lineamiento->id) {
                return back()->withErrors('No se puede asignar más de un lineamiento a un usuario');                
            }
        }

        $rol_id = DB::table('role_user')->where('user_id', $request->get('user'))->first();
        if (!$rol_id) {
            $lineamiento = Lineamiento::where('name', $request->get('name'))->first();
            return redirect('root/lineamientos/' . $lineamiento->id . '/editar')->withErrors('Debes asignarle el rol Manager al usuario antes de darle un lineamiento');
        }

        $rol = Role::whereId($rol_id->role_id)->first();
        if ($rol->name != 'Manager') {

            $lineamiento = Lineamiento::where('name', $request->get('name'))->first();
            return redirect('root/lineamientos/' . $lineamiento->id . '/editar')->withErrors('No se puede asignar un lineamiento a un administrador, solo a encargados');
        }

        $lineamiento = Lineamiento::where('name', $request->get('name'))->first();

        $lineamiento->name = $request->get('name');
        $lineamiento->user_id = implode("", $request->get('user'));

        $lineamiento->save();

        return redirect(action('Root\LineamientoController@editLineamientos', $lineamiento->id))->with('status', 'El lineamiento ha sido actualizado!');    
    }
}
