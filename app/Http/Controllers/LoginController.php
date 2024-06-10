<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index($id){
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
            return response()->json(['message' => 'User not found!', 'data' => '']);
        } else {
            if (Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'User successfully founded!', 'data' => $user]);
            } else {
                return response()->json(['message' => 'Incorrect password!', 'data' => '']);
            }
        }
    }
}
