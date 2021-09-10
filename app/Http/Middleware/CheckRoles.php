<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        if ($user->roles === $role) {
            return $next($request);
        }
        session()->flash('message','Waduh Anda Bukan Admin Lurrr!');
        session()->flash('type','warning');
        return redirect()->back();

    }
}
