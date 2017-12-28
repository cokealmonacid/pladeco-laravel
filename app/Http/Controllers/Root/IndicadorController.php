<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\IndicadorFormRequest;
use App\Http\Controllers\Controller;
use App\Indicador;
use App\Iniciativa;
use App\Componente;

class IndicadorController extends Controller
{
    public function indicadores()
    {
    	$indicadores = Indicador::all();

    	$iniciativas = Iniciativa::all();

    	$componentes = Componente::all();

    	return view('Root.Indicadores.index', compact('indicadores', 'iniciativas', 'componentes'));
    }

    public function createIndicador()
    {
    	$iniciativas = Iniciativa::all();

    	return view('Root.Indicadores.register', compact('iniciativas'));
    }

    public function storeIndicador(IndicadorFormRequest $request)
    {
    	$indicador = new Indicador(array(
    		'name' => $request->get('name'),
    		'iniciativa_id' => implode("", $request->get('iniciativa'))
    	));

    	$indicador->save();

    	return back()->with('status', 'El indicador ha sido creado');
    }

    public function destroyIndicador($id)
    {
    	$indicador = Indicador::whereid($id)->firstOrFail();

    	$indicador->delete();

    	return redirect('root/indicadores')->with('status', 'El indicador se ha eliminado!');
    }
}
