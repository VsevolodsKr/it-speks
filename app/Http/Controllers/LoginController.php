<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index($id)
    {
        return User::where('id', $id)->get();
    }
    public function enter(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;
            return response()->json(['message' => 'Lietotājs atrasts!', 'data' => $user, 'token' => $token]);
        } else {
            return response()->json(['message' => 'Lietotājs nav atrasts!'], 500);
        }

    }

}
