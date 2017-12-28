<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class PagesController extends Controller
{
    public function redirect()
    {
        if(!Auth::check()) {
            return redirect('users/login');
        } else {
            $user = Auth::user();
            if($user->hasRole('Manager'))
            {
                return redirect('manager/');
            }
            if($user->hasRole('Administrador'))
            {
                return redirect('administrador/');
            }
            if($user->hasRole('Root'))
            {
                return redirect('root/');
            }
		}
    }
}
