<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        return redirect('/home')->with('message', 'Access Denied.')->with('alert', 'danger');
    }

    public function viewroles()
    {
        $roles = User::pluck('role', 'id'); 
        return view('product.index', ['role' => $roles]);
    }

}





