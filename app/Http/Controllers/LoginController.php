<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function enter(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required | min:8'
        ]);
        $user = User::where('username', '=', $request->username)->first();
        if(!$user){
            return response()->json(['message' => 'User not found!', 'data' => '']);
        }else{
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loggedUser', $user->id);
                return redirect(route('/admin', $user->id));
            }else{
                return response()->json(['message' => 'Incorrect password!', 'data' => '']);
            }
        }
    }
}
