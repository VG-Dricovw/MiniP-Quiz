<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Cache;
use DB;

class ValidateAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $uri = $request->getRequestUri();
        // dd($uri);
        //5 is for index
        if (strlen($uri) === 5 || str_contains($uri, "show")) {
            return $next($request);
        } else {
            $userEmail = Cache::get('email');
            $user = DB::table("users")->where("email", "=", $userEmail)->first();
            switch ($user->role) {
                case "user":
                    return redirect("/")->with("warning", "not authorized");
                case "creator":
                    return $next($request);
                case "admin":
                    return $next($request);
            }
        }
    }
}
