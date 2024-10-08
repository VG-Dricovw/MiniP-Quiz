<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserAPIController extends Controller
{

    public function index()
    {
        $user = User::all();
        if ($user->count() > 0) {
            return response()->json($user);
        } else {
            return redirect()->back()->with("error", "no user found");
        }

    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password );
        $user->save();
        return response()->json([
            "message" => "user added",
            "id" => $user->id
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            return response()->json($user);
        } else {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->password = is_null($request->password) ? $user->password : $request->password;
            $user->save();
            return response()->json([
                'message' => 'user updated'
            ], 200);
        } else {
            return response()->json([
                'message' => 'user not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                "message" => "deleted user"
            ], 202);
        } else {
            return response()->json([
                "message" => "user not found"
            ], 404);

        }

    }
}