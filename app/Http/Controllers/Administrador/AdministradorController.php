<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Lineamiento;
use App\Objetivo;
use App\Componente;
use App\Iniciativa;
use App\Indicador;
use App\Actividad;
use App\Verificacion;
use App\Historial;
use DB;

class AdministradorController extends Controller
{
    public function home(){
    	$medios = verificacion::where('status',1)->get();

        $iniciativas = Iniciativa::where('status',2)->get();

        $iniciativasMV = Iniciativa::all();

        $lineamientos = Lineamiento::all();

    	$count = count($medios);

        $countIniciativas = count($iniciativas);

        $indicadores = Indicador::all();

        $actividades = Actividad::all();

        $verificaciones = Verificacion::all();

        $componentes = Componente::all();

    	return view('Administrador.index', compact('medios', 'count', 'iniciativas', 'countIniciativas', 'indicadores', 'actividades', 'verificaciones', 'lineamientos', 'iniciativasMV', 'componentes'));
    }

    public function lineamientos()
    {
        $lineamientos = Lineamiento::all();

        $users = User::all();   

        return view('Administrador.Lineamientos.index', compact('lineamientos', 'users'));
    }

    public function iniciativas($id)
    {
        $iniciativas = Iniciativa::where('componente_id', $id)->get();

        $componente = Componente::whereId($id)->firstOrFail();

        $lineamiento = Lineamiento::where('id',$componente->lineamiento_id)->firstOrFail();

        $actividades = Actividad::all();

        $indicadores = Indicador::all();

        $verificaciones = Verificacion::all();

        return view('Administrador.Iniciativas.index', compact('iniciativas', 'actividades', 'indicadores', 'verificaciones', 'componente', 'lineamiento'));
    }

    public function showLineamiento($id)
    {
        $lineamiento = Lineamiento::whereId($id)->first();

        $user = User::whereId($lineamiento->user_id)->first();

        $objetivo = Objetivo::where('lineamiento_id', $lineamiento->id)->first();

        $componentes = Componente::where('lineamiento_id', $lineamiento->id)->get();

        $iniciativas = Iniciativa::all();

        $verificaciones = Verificacion::all();

        $actividades = Actividad::all();

        $indicadores = Indicador::all();

        return view('Administrador.Lineamientos.lineamiento', compact('user', 'lineamiento', 'objetivo', 'componentes', 'iniciativas', 'verificaciones', 'actividades', 'indicadores'));
    }

    public function acceptFile($id)
    {
    	$medio = Verificacion::whereId($id)->firstOrFail();

    	$medio->status = 2;

    	$medio->save();

    	return back()->with('status', 'El medio d everificación ha sido aceptado');
    }

    public function rejectFile($id)
    {
    	$medio = Verificacion::whereId($id)->firstOrFail();

    	$medio->status = 3;

        $medio->file = "";

    	$medio->save();

    	return back()->withErrors('El medio de verificación ha sido rechazado');
    }

    public function acceptRequest($id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $iniciativa->status = 0;

        $iniciativa->save();

        $temporal = DB::table('temporal')->where('id_iniciativaT', $id)->first();

        $iniciativaOld = Iniciativa::whereId($temporal->id_iniciativa)->first();

        $iniciativaOld->delete();

        $temporal = DB::table('temporal')->where('id_iniciativaT', $id)->delete();

        return back();
    }

    public function rejectRequest($id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $iniciativa->status = 3;

        $iniciativa->save();

        return back();
    }

    public function showHistorial()
    {

        $historias = Historial::all();

        $users = User::all();

        $lineamientos = Lineamiento::all();

        return view('Administrador.Historial.index', compact('historias', 'users', 'lineamientos'));
    }
}
