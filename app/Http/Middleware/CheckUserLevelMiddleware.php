<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$user_level): Response
    {
        $user = Auth::user();

        if ($user && in_array($user->user_level, $user_level))
        {
            return $next($request);
        }

        $redirect_route = ($user->user_level == 'super admin') ? 'admin.index' : ($user->user_level == 'admin' ? 'artist.index' : 'artwork.index');
        return redirect(route($redirect_route));
    }
}
