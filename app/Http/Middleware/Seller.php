<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Seller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->hasRole(User::$ROLE_SELLER_ID)) {
            return $next($request);
        }

        session()->flash('message', 'Доступ запрещен');
        return redirect()->to('dashboard');
    }
}
