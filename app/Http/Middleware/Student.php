<?php

namespace App\Http\Middleware;

use Closure;

class Student
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
        } else if($user->admin == 1) {
          return response()->json(['success' => false, 'message' => "Non étudiant"], 401);
        }
        return $next($request);
    }
}
