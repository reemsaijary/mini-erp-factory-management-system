<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    //get the request, get the next step, also get the role we want, like admin or employe
    public function handle(Request $request, Closure $next, string $role): Response
    {
        //if user is not logged in
        if (!auth()->check()) {
            return redirect()->route('login');//send them to login page
        }
     //if the logged-in user’s role is not the required role
        if (auth()->user()->role !== $role) {
            //show forbidden page
            abort(403, 'Unauthorized access');
        }
    //if everything is okay, let the user continue to the route
        return $next($request);
    }
}