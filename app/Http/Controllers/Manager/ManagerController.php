<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UploadFileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Lineamiento;
use App\Objetivo;
use App\Componente;
use App\Iniciativa;
use App\Indicador;
use App\Actividad;
use App\Verificacion;
use DB;
use App\temp;
use App\Historial;

class ManagerController extends Controller
{
    public function home(){
    	$user = Auth::user();

    	$lineamiento = Lineamiento::where('user_id',$user->id)->first();

    	$objetivo = Objetivo::where('lineamiento_id', $lineamiento->id)->first();

        $cantComp = Componente::where('lineamiento_id', $lineamiento->id)->count();

        $componentes = Componente::where('lineamiento_id', $lineamiento->id)->get();

    	$iniciativas = Iniciativa::all();

        $verificaciones = Verificacion::all();

        $actividades = Actividad::all();

        $indicadores = Indicador::all();

        $porcentaje = array(
            'componente', 'verificacion'
        );

        $porcentajeT = 0;
        $verTotal = 0;
        $cantIni = 0;
        $cantInd = 0;
        $cantAct = 0;
        $cantMV = 0;

        foreach ($componentes as $componente) {
            $inic = Iniciativa::where('componente_id', $componente->id)->count();
            $cantIni = $cantIni + 1;
            foreach ($iniciativas as $iniciativa) {
                $ind = Indicador::where('iniciativa_id', $iniciativa->id)->count();
                $cantInd = $cantInd + 1;
                $act = Actividad::where('iniciativa_id', $iniciativa->id)->count();
                $cantAct = $cantAct + 1;
                $mv = Verificacion::where('iniciativa_id', $iniciativa->id)->count();
                $cantMV= $cantMV + 1;
                $contReady = 0;
                if ($iniciativa->componente_id == $componente->id) {

                    $verificacionesN = Verificacion::where('iniciativa_id', $iniciativa->id)->count();

                    $verificacionesT = Verificacion::where('iniciativa_id', $iniciativa->id)->get();

                    foreach($verificacionesT as $vt){
                        if($vt->status == 2){
                            $contReady = $contReady + 1;
                        }
                    }

                    if($verificacionesN == 0){
                        $componente->porcentaje = 0;
                    } else {
                        $componente->porcentaje = intval(($contReady/$verificacionesN)*100);
                    }
                }

                $verTotal = $verTotal + $verificacionesN;
            }
        }

        $porcentajeT = intval(($cantComp/$verTotal) * 100);


    	return view('Manager.index', compact('user', 'lineamiento', 'objetivo', 'componentes', 'iniciativas', 'user', 'cantComp', 'verificaciones', 'activiades', 'indicadores', 'porcentajeT', 'cantIni', 'cantInd', 'cantAct', 'cantMV'));
    }

    public function lineamientos()
    {
    	$lineamientos = Lineamiento::all();

    	$users = User::all();

        $user = Auth::user();

        $userid = $user->id;        

    	return view('Manager.Lineamientos.index', compact('lineamientos', 'users', 'userid'));
    }

    public function componentes()
    {
        $user = Auth::user();

        $lineamiento = Lineamiento::where('user_id', $user->id)->first();

        $componentes = Componente::where('lineamiento_id', $lineamiento->id)->get();

        $iniciativas = Iniciativa::all();

        foreach ($componentes as $componente) {
            foreach ($iniciativas as $iniciativa) {
                $contReady = 0;
                if ($iniciativa->componente_id == $componente->id) {

                    $verificacionesN = Verificacion::where('iniciativa_id', $iniciativa->id)->count();

                    $verificacionesT = Verificacion::where('iniciativa_id', $iniciativa->id)->get();

                    foreach($verificacionesT as $vt){
                        if($vt->status == 2){
                            $contReady = $contReady + 1;
                        }
                    }

                    if($verificacionesN == 0){
                        $componente->porcentaje = 0;
                    } else {
                        $componente->porcentaje = intval(($contReady/$verificacionesN)*100);
                    }
                }
            }
        }

        return view('Manager.Componentes.index', compact('componentes'));
    }

    public function iniciativas($id)
    {
        $componente = Componente::whereId($id)->firstOrFail();

        $iniciativas = Iniciativa::where('componente_id', $id)->get();

        $indicadores = Indicador::all();

        $actividades = Actividad::all();

        return view('Manager.Iniciativas.index', compact('componente', 'iniciativas', 'indicadores', 'actividades'));
    }

    public function iniciativasLineamientos($id)
    {
        $componente = Componente::whereId($id)->firstOrFail();

        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $iniciativas = Iniciativa::where('componente_id', $id)->get();

        $indicadores = Indicador::all();

        $actividades = Actividad::all();

        $verificaciones = Verificacion::all();

        return view('Manager.Lineamientos.iniciativa', compact('componente', 'iniciativas', 'indicadores', 'actividades', 'lineamiento', 'verificaciones'));
    }

    public function acceptIniciativa($id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $componente = Componente::whereId($iniciativa->componente_id)->firstOrFail();

        $iniciativa->status = 4;

        $iniciativa->save();

        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $historial = new Historial(array(
            'accion' => 'Se ha aceptado la iniciativa:"' . $iniciativa->objetive .'"',
            'user_id' => $lineamiento->user_id,
            'type' => 'iniciativa'
        ));

        $historial->save();

        return redirect('/manager/componentes/'. $componente->id . '/iniciativas')->with('status', 'La Iniciativa ha sido aceptada');
    }

    public function editIniciativa($id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $actividades = Actividad::where('iniciativa_id', $iniciativa->id)->get();

        $verificaciones = Verificacion::where('iniciativa_id', $iniciativa->id)->get();

        $indicadores = Indicador::where('iniciativa_id', $iniciativa->id)->get();

        $componentes = Componente::all();

        return view('Manager.Iniciativas.edit', compact('iniciativa', 'actividades', 'verificaciones', 'indicadores', 'componentes'));
    }

    public function showMedios($id)
    {
        $medios = Verificacion::all();

        $iniciativa = Iniciativa::whereId($id)->first();

        return view('Manager.Verificaciones.index', compact('medios', 'iniciativa'));
    }

    public function updateIniciativa(Request $request, $id)
    {
        $sameIniciativa = Iniciativa::whereId($id)->firstOrFail();

        $iniciativa = new Iniciativa();

        if ($request->get('justificacion') != "") {
            $iniciativa->justify = $request->get('justificacion');
        } else {
            $iniciativa->justify = $sameIniciativa->justify;            
        }

        if ($request->get('objetive') != "") {
            $iniciativa->objetive = $request->get('objetive');
        } else {
            $iniciativa->objetive = $sameIniciativa->objetive;            
        }

        if ($request->get('responsable') != "") {
            $iniciativa->responsable = $request->get('responsable');
        } else {
            $iniciativa->responsable = $sameIniciativa->responsable;            
        }

        if ($request->get('area') != "") {
            $iniciativa->area = $request->get('area');
        } else {
            $iniciativa->area = $sameIniciativa->area;            
        }

        if ($request->get('coresponsable') != "") {
            $iniciativa->coresponsable = $request->get('coresponsable');
        } else {
            $iniciativa->coresponsable = $sameIniciativa->coresponsable;            
        }

        if ($request->get('cartera') != "") {
            $iniciativa->cartera = $request->get('cartera');
        } else {
            $iniciativa->cartera = $sameIniciativa->cartera;            
        }

        $iniciativa->status = 1;

        $iniciativa->componente_id = $sameIniciativa->componente_id;

        $iniciativa->save();

        $sameIniciativa->status = 5;

        $sameIniciativa->save();

        $temporal = new temp(array(
            'id_iniciativa' => $sameIniciativa->id,
            'id_iniciativaT' => $iniciativa->id
        ));

        $temporal->save();

        $componente = Componente::whereId($sameIniciativa->componente_id)->firstOrFail();
        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $historial = new Historial(array(
            'accion' => 'Se ha editado la iniciativa:"' . $iniciativa->objetive .'"',
            'user_id' => $lineamiento->user_id,
            'type' => 'iniciativa'
        ));

        $historial->save();

        return redirect('/manager/componentes/' . $sameIniciativa->componente_id .'/iniciativas')->with('status', 'La iniciativa ha sido editada');
    }

    public function deleteIniciativa($id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $iniciativa->delete();

        $indicadores = Indicador::where('iniciativa_id', $id)->delete();

        $actividades = Actividad::where('iniciativa_id', $id)->delete();

        $verificacion = Verificacion::where('iniciativa_id', $id)->delete();

        $temporal = DB::table('temporal')->where('id_iniciativaT', $id)->first();

        $iniciativaM = Iniciativa::whereId($temporal->id_iniciativa)->first();

        $iniciativaM->status = 0;

        $iniciativaM->save();

        $componente = Componente::whereId($iniciativaM->componente_id)->firstOrFail();
        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $historial = new Historial(array(
            'accion' => 'Se ha cancelado una edición de iniciativa',
            'user_id' => $lineamiento->user_id,
            'type' => 'iniciativa'
        ));

        $historial->save();

        $temporal = DB::table('temporal')->where('id_iniciativaT', $id)->delete();

        return redirect('/manager/componentes/' . $iniciativaM->componente_id .'/iniciativas')->with('status', 'La edición de iniciativa ha sido cancelada');
    } 

    public function makeRequest($id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $iniciativa->status = 2;

        $iniciativa->save();

        $componente = Componente::whereId($iniciativa->componente_id)->firstOrFail();
        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $historial = new Historial(array(
            'accion' => 'Se ha realizado una solicitud de modificación de la iniciativa:"' . $iniciativa->objetive . '"',
            'user_id' => $lineamiento->user_id,
            'type' => 'iniciativa'
        ));

        $historial->save();

        return redirect('/manager/componentes/' . $iniciativa->componente_id . '/iniciativas');
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

        return view('Manager.Lineamientos.lineamiento', compact('user', 'lineamiento', 'objetivo', 'componentes', 'iniciativas', 'verificaciones', 'actividades', 'indicadores'));
    }

    public function uploadFile(UploadFileRequest $request, $id)
    {
        $verificacion = Verificacion::whereId($id)->first();

        if (!$verificacion) {
            return back()->withError('Error al subir un medio de verificación');
        }

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $name = $file->getClientOriginalName();

            $file->move(public_path() . '/data/', $name);

            $verificacion->file = $name;

            $verificacion->status = 1;

            $verificacion->save();

            $iniciativa = Iniciativa::whereId($verificacion->iniciativa_id)->first();
            $componente = Componente::whereId($iniciativa->componente_id)->firstOrFail();
            $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

            $historial = new Historial(array(
                'accion' => 'Se ha subido el medio de verificación:"' . $verificacion->name . '"',
                'user_id' => $lineamiento->user_id,
                'type' => 'verificacion'
            ));

            $historial->save();
        }

        return back()->with('status', 'El medio de verificacion ha sido subido con éxito');
    }

    public function downloadFile($id)
    {
        $verificacion = Verificacion::whereId($id)->first();

        if (!$verificacion) {
            return back()->withError('Ocurrio un problema mientras se intentaba descargar el archivo');
        }

        $name_file = $verificacion->file;

        return response()->download(public_path() . '/data/' . $name_file);
    }

    public function deleteFile($id)
    {
        $verificacion = Verificacion::whereid($id)->first();

        $verificacion->file = "";

        $verificacion->status = 0;

        $iniciativa = Iniciativa::whereId($verificacion->iniciativa_id)->first();
        $componente = Componente::whereId($iniciativa->componente_id)->firstOrFail();
        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $historial = new Historial(array(
            'accion' => 'Se ha eliminado el medio de verificación:"' . $verificacion->name . '"',
            'user_id' => $lineamiento->user_id,
            'type' => 'verificacion'
        ));

        $historial->save();

        $verificacion->save();

        return back()->with('status', 'El medio de verificación ha sido eliminado');
    }

    public function addMedios(Request $request, $id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $actividad = new Verificacion(array(
            'name' => $request->get('name'),
            'iniciativa_id' => $iniciativa->id
        ));

        $actividad->save();

        $componente = Componente::whereId($iniciativa->componente_id)->firstOrFail();
        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $historial = new Historial(array(
            'accion' => 'Se ha agregado el medio:"' . $actividad->name . '"',
            'user_id' => $lineamiento->user_id,
            'type' => 'verificacion'
        ));

        $historial->save();

        return redirect('/manager/iniciativas/'.$iniciativa->id.'/medios-de-verificacion')->with('status', 'El medio de verificación se ha agregado con éxito!'); 
    }

    public function addIndicador($id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        return view('Manager.Indicadores.index', compact('iniciativa'));
    }

    public function storeIndicador(Request $request, $id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $indicador = new Indicador(array(
            'name' => $request->get('name'),
            'iniciativa_id' => $iniciativa->id
        ));

        $indicador->save();

        $componente = Componente::whereId($iniciativa->componente_id)->firstOrFail();
        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $historial = new Historial(array(
            'accion' => 'Se ha agregado el indicador:"' . $indicador->name . '"',
            'user_id' => $lineamiento->user_id,
            'type' => 'indicador'
        ));

        $historial->save();

        return back()->with('status', 'El indicador se ha agregado con éxito!');
    }

    public function addActividad($id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        return view('Manager.Actividad.index', compact('iniciativa'));
    }

    public function storeActividad(Request $request, $id)
    {
        $iniciativa = Iniciativa::whereId($id)->firstOrFail();

        $actividad = new Actividad(array(
            'name' => $request->get('name'),
            'iniciativa_id' => $iniciativa->id
        ));

        $actividad->save();

        $componente = Componente::whereId($iniciativa->componente_id)->firstOrFail();
        $lineamiento = Lineamiento::whereId($componente->lineamiento_id)->firstOrFail();

        $historial = new Historial(array(
            'accion' => 'Se ha agregado la actividad:"' . $actividad->name . '"',
            'user_id' => $lineamiento->user_id,
            'type' => 'actividad'
        ));

        return back()->with('status', 'La actividad se ha agregado con éxito!');
    }

    public function showHistorial()
    {
        $user = Auth::user();

        $historias = Historial::where('user_id',$user->id)->get();

        return view('Manager.Historial.index', compact('historias'));
    }

    public function showConfiguracion()
    {
        $user = Auth::user();

        return view('Manager.Cuenta.index', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $password = $request->get('pass');

        $newpassword = $request->get('new-pass');

        if (strcmp($password, $newpassword)) {
            return back()->withErrors('Los passwords ingresados no coinciden');
        }

        $user = Auth::user();

        $user->password = Hash::make($password);

        $user->save();

        return back()->with('status', 'Su contraseña se ha cambiado con éxito!');
    }
}
