<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ActividadFormRequest;
use App\Http\Controllers\Controller;

use App\Actividad;
use App\Iniciativa;
use App\Componente;

class ActividadController extends Controller
{
    public function actividades()
    {
    	$actividades = Actividad::all();

    	$iniciativas = Iniciativa::all();

    	$componentes = Componente::all();

    	return view('Root.Actividades.index', compact('actividades', 'iniciativas', 'componentes'));
    }

    public function createActividad()
    {
    	$iniciativas = Iniciativa::all();

    	return view('Root.Actividades.register', compact('iniciativas'));
    }

    public function storeActividad(ActividadFormRequest $request)
    {
    	$actividad = new Actividad(array(
    		'name' => $request->get('name'),
    		'iniciativa_id' => implode("", $request->get('iniciativa'))
    	));

    	$actividad->save();

    	return back()->with('status', 'La actividad ha sido creada');
    }

    public function destroyActividad($id)
    {
    	$actividad = Actividad::whereid($id)->firstOrFail();

    	$actividad->delete();

    	return redirect('root/actividades')->with('status', 'El actividad se ha eliminado!');
    }
}
