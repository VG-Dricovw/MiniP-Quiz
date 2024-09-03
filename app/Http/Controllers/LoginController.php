<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
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
        $validated = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $users = DB::table("users")->whereNotNull("email_verified_at")->get();

        if ($users->count() > 0) {
            // var_dump($validated);
            // dd($users->first());
            foreach ($users as $user) {
                if ($user->email == $validated["email"] && Hash::check($request->password, $user->password)) {
                    return redirect("/")->with("success", "logged in");
                }
            }
                echo "no matching user found";
        } else {
            return redirect("/login")->with("error", "no matching user found");
        }
    }

    public function appRegister(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        return redirect("/")->with("success", "registered");
    }


    public function appLogout(Request $request)
    {
        // session_destroy() && session()->invalidate();


        return redirect("/login")->with("success", "logged out");
    }
}