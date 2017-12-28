<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VerificacionFormRequest;
use App\Http\Controllers\Controller;
use App\Verificacion;
use App\Iniciativa;
use App\Componente;

class VerificacionController extends Controller
{
    public function verificaciones()
    {
    	$verificaciones = Verificacion::all();

    	$iniciativas = Iniciativa::all();

    	$componentes = Componente::all();

    	return view('Root.Verificaciones.index', compact('verificaciones', 'iniciativas', 'componentes'));
    }

    public function createVerificacion()
    {
    	$iniciativas = Iniciativa::all();

    	return view('Root.Verificaciones.register', compact('iniciativas'));
    }

    public function storeVerificacion(VerificacionFormRequest $request)
    {
    	$verificacion = new Verificacion(array(
    		'name' => $request->get('name'),
    		'iniciativa_id' => implode("", $request->get('iniciativa')),
            'satus' => 0
    	));

    	$verificacion->save();

    	return back()->with('status', 'La verificación ha sido creada');
    }

    public function destroyVerificacion($id)
    {
    	$verificacion = Verificacion::whereid($id)->firstOrFail();

    	$verificacion->delete();

    	return redirect('root/verificaciones')->with('status', 'La verificación se ha eliminado!');
    }
}
