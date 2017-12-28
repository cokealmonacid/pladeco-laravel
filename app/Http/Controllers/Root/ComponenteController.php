<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ComponenteFormRequest;
use App\Http\Controllers\Controller;
use App\Componente;
use App\Lineamiento;

class ComponenteController extends Controller
{
    public function componentes()
    {
    	$componentes = Componente::all();

    	$lineamientos = Lineamiento::all();

    	return view('Root.Componentes.index', compact('componentes', 'lineamientos'));
    }

    public function createComponente()
    {
    	$lineamientos = Lineamiento::all();

    	return view('Root.Componentes.register', compact('lineamientos'));
    }

    public function storeComponente(ComponenteFormRequest $request)
    {
    	$componente = new Componente(array(
    		'name' => $request->get('name'),
    		'objetive' => $request->get('objetive'),
    		'lineamiento_id' => implode("", $request->get('lineamiento'))
    	));

    	$componente->save();

    	return back()->with('status', 'El componente ha sido creado!');
    }

    public function editComponente($id)
    {
        $componente = Componente::whereId($id)->firstOrFail();

        $lineamientos = Lineamiento::all();

        return view('Root.Componentes.edit', compact('componente','lineamientos'));
    }

    public function updateComponente(Request $request, $id)
    {
        $componente = Componente::whereId($id)->firstOrFail();

        if ($request->get('name') != "") {
            $componente->name = $request->get('name');
        }

        if ($request->get('objetive') != "") {
            $componente->objetive = $request->get('objetive');
        }

        $componente->lineamiento_id = implode("", $request->get('lineamiento'));

        $componente->save();

        return back()->with('status', 'El componente ha sido actualizado!');
    }

    public function destroyComponente($id)
    {
        $componente = Componente::whereId($id)->firstOrFail();

        $componente->delete();

        return redirect('/root/componentes')->with('status', 'Un componente ha sido elinado!');
    }

}
