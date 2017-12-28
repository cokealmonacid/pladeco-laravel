<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ObjetivoFormRequest;
use App\Http\Controllers\Controller;
use App\Objetivo;
use App\Lineamiento;

class ObjetivoController extends Controller
{
    public function objetivos()
    {
    	$objetivos = Objetivo::all();
        $lineamientos = Lineamiento::all();

    	return view('Root.Objetivos.index', compact('objetivos', 'lineamientos'));
    }

    public function createObjetivo()
    {
    	$lineamientos = Lineamiento::all();

    	return view('Root.Objetivos.register', compact('lineamientos'));
    }

    public function storeObjetivo(ObjetivoFormRequest $request)
    {
    	$lineamiento = Lineamiento::where('name', $request->get('lineamiento'))->first();

        $objetivo = new Objetivo(array(
            'description' => $request->get('descripcion'),
            'lineamiento_id' => $lineamiento->id
        ));

        $objetivo->save();

        return back()->with('status', 'El objetivo a sido creado!');
    }

    public function editObjetivo($id)
    {
        $objetivo = Objetivo::whereId($id)->first();

        $lineamientos = Lineamiento::all();

        return view('Root.Objetivos.edit')->with(compact('objetivo', 'lineamientos'));
    }

    public function updateObjetivo(Request $request, $id)
    {
        $objetivo = Objetivo::whereId($id)->first();

        $objetivo->description = $request->get('descripcion');
        $objetivo->lineamiento_id = implode("", $request->get('lineamiento'));

        $objetivo->save();

        return back()->with('status', 'El objetivo ha sido actualizado!');
    }

    public function destroyObjetivo($id)
    {
        $objetivo = Objetivo::whereId($id)->firstOrFail();

        $objetivo->delete();

        return redirect('/root/objetivos')->with('status', 'El objetivo ha sido eliminado!');
    }
}
