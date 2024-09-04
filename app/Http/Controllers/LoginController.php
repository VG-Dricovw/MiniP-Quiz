<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use Cache;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function api(Request $request)
    {
        $user = auth()->user();
        $token = auth()->login($user);
    }

    public function app(Request $request)
    {
        switch ($request->getRequestUri()) {
            case "/login":
                return view("/account/login");
            case "/register":
                return view("/account/register");
            case "/logout":
                $this->appLogout($request);
        }
    }



    public function appLogin(Request $request)
    {
        $users = DB::table("users")->whereNotNull("email_verified_at")->get();

        $validated = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        if ($users->count() > 0) {
            // var_dump($validated);
            // dd($users->first());
            foreach ($users as $user) {
                if ($user->email == $validated["email"] && Hash::check($request->password, $user->password)) {
                    Cache::put($validated, now()->addMinutes(60));
                    Cache::add("role", $user->role);
                    return redirect("/")->with("success", "logged in");
                }
            }
            return redirect("/login")->with("warning", "no matching user found");
        } else {
            return redirect("/login")->with("warning", "no users found in database");
        }
    }

    public function appRegister(Request $request)
    {

        $request->request->add(['name' => substr($request->email, 0, strpos($request->email, "@"))]);
        $request->request->set('password', Hash::make($request->password));
        $validated = $request->validate([
            "email" => "required|email",
            "password" => "required",
            "name" => "required",
        ]);


        $users = DB::table("users")->insert($validated);
        if ($users) {
            Cache::put($validated, now()->addMinutes(60));
            return redirect("/")->with("success", "registered");
        } else {
            return redirect("/login")->with("warning", "could not register this user");
        }
    }


    public function appLogout(Request $request)
    {
        // session_destroy() && session()->invalidate();
        Cache::flush();


        return redirect("/login")->with("success", "logged out");
    }
}