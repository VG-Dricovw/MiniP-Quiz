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
        $credentials = $request->only('email', 'password');
        var_dump(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);
            return response()->json(compact('token'));
        }
        return response()->json(['error'=> 'invalid credentials'],401);
    }

    public function protectedEndpoint(Request $request) {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error'=> 'token expired'],401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error'=> 'invalid token'],401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error'=> 'token is missing'],401);
        }

        return response()->json(['success'=> true, "message" => "you are autherized"]);
    }


    //     $users = User::all();
    //     // var_dump($apiuseremail);
    //     if ($users->count() > 0) {
    //         foreach ($users as $user) {
    //             if ($user->email === $apiuseremail && Hash::check($apiuserpassword, $user->password)) {
    //                 //make token
    //                 echo "return the token";
    //                 exit;
    //             }
    //         }
    //         echo "no email matching";
    //     } else {
    //         return redirect()->back()->with("error", "no users found in the database");
    //     }
    // }

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
