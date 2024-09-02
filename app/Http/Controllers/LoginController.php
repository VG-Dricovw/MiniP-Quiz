<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function api(Request $request)
    {
        $user = auth()->user();
        $token = auth()->login($user);
    }

    public function app(Request $request)
    {
        $json = [];
        $apiuseremail = $request->email;
        $apiuserpassword = $request->password;
        $users = User::all();
        var_dump($apiuseremail);
        if ($users->count() > 0) {
            foreach ($users as $user) {
                if ($user->email === $apiuseremail && Hash::check($apiuserpassword, $user->password)) {
                    //make token
                    echo "ok verify";
                    exit;
                }
            }
            echo "no email matching";
        } else {
            return redirect()->back()->with("error", "no users found in the database");
        }
    }
}
