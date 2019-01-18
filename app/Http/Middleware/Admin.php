<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        $user = auth()->user();
        if(!auth()->check()){
          return response()->json(['success' => false, 'message' => "Non connecté"], 401);
        } else if($user->admin == 0) {
          return response()->json(['success' => false, 'message' => "Non admin"], 401);
        }
        return $next($request);
    }
}
