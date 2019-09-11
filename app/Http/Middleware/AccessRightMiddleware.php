<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;

use App\User;
use Auth;

class AccessRightMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$access_rights)
    {   
        foreach ($access_rights as $access_right) 
        {
            if (! User::hasAccessRight($access_right)) {
                return new Response(view('unauthorized', ['access_rights' => $access_rights, 'user' => Auth::user()]));
            }
        }
        
        return $next($request);
    }
}
