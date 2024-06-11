<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index($id)
    {
        return User::where('id', $id)->get();
    }
    public function enter(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', '=', $request->username)->first();
        if (!$user) {
            // return response()->json(['message' => 'User not found!', 'data' => '']);
            //return error
            return response()->json(['message' => 'User not found!'], 500);
        } else {
            if (Hash::check($request->password, $user->password)) {
                // return $user->createToken('usertoken')->accessToken;
                return response()->json(['message' => 'User found successfully!', 'data' => $user]);
            } else {
                return response()->json(['message' => 'Incorrect password!', 'data' => '']);
            }
        }
    }

}
