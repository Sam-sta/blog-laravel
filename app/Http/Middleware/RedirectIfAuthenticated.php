<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user($guard);

                if($user->hasRole('Administrador')) {
                    return redirect(route('dashboard'));
                }

                else if($user->hasRole('Invitado')) {
                    return redirect(route('home'));
                }

                else if($user->hasRole('Publicista')) {
                    return redirect(route('posts.index'));
                }
            }
        }

        return $next($request);
    }
}
