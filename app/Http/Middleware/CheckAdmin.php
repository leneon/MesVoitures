<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('log');
        }
        $iduser = Auth::user()->id;//$user = User::find(1);
        $cur_user = User::find($iduser);
        if($cur_user['type']=="client"){
            return redirect('dashboard');
        }
        return $next($request);
    }
}
