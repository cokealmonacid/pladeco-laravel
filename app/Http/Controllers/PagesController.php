<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use DB;

class PagesController extends Controller
{
    public function redirect()
    {
        dd(!Auth::check());
        if (!Auth::check())
        {
            return redirect('/');
        } else {
            $user = Auth::user();

            $user_rol = DB::table('role_user')->where('user_id', $user->id)->get();
            $rol_id = $user_rol[0]->role_id;
            switch ($rol_id) {
                case 1:
                    return redirect('root/');
                    break;
                case 2:
                    return redirect('manager/');
                    break;
                case 3:
                    return redirect('administrador/');
                    break;
                
                default:
                    return redirect('/');
                    break;
            }
        }
    }
}
