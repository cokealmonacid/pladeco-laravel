<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use DB;

class Guardian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();
        dd($user);
        if ($user == null) 
        {
            return redirect('/');
        }

        $user_rol = DB::table('role_user')->where('user_id', $user->id)->get();
        if ($user_rol[0]->role_id != $role) 
        {
            return redirect('/');
        }

        return $next($request);
    }
}