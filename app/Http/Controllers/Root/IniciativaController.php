<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\IniciativaFormRequest;
use App\Http\Controllers\Controller;
use App\Iniciativa;
use App\Lineamiento;
use App\Componente;

class IniciativaController extends Controller
{
    public function iniciativas()
    {
    	$iniciativas = Iniciativa::all();

    	$lineamientos = Lineamiento::all();

    	$componentes = Componente::all();

    	return view('Root.Iniciativas.index', compact('iniciativas', 'lineamientos', 'componentes'));
    }

    public function createIniciativa()
    {
    	$componentes = Componente::all();

    	return view('Root.Iniciativas.register', compact('componentes'));
    }

    public function storeIniciativa(IniciativaFormrequest $request)
    {
    	$iniciativa = new Iniciativa(array(
    		'justify' => $request->get('justificacion'),
    		'objetive' => $request->get('objetive'),
    		'area' => $request->get('area'),
    		'responsable' => $request->get('responsable'),
    		'coresponsable' => $request->get('coresponsable'),
    		'status' => 0,
    		'componente_id' => implode("", $request->get('componente')),
            'cartera' => $request->get('cartera')
    	));

    	$iniciativa->save();

    	return back()->with('status', 'Se ha creado una nueva iniciativa!');
    }

    public function destroyIniciativa($id)
    {
    	$iniciativa = Iniciativa::whereId($id)->firstOrFail();

    	$iniciativa->delete();

    	return redirect('/root/iniciativas')->with('status', 'La iniciativa ha sido eliminada');
    }
}
