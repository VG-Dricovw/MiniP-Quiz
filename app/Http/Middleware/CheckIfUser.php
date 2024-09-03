<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Cache;

class CheckIfUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uri = $request->getRequestUri();
        if (str_contains($uri, "login") || str_contains($uri, "register") || str_contains($uri, "logout")) {
            return $next($request);
        } else {
            //this is when no account
            if (Cache::has('email')) {
                return $next($request);
            } else {
                return redirect("/login")->with("warning", "registrate or login");
            }
        }
    }
}
