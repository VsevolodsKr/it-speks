<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function index($id)
    {
        return User::where('id', $id)->get();
    }
    public function enter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Lūdzu, ievadiet Jūsu lietotājvārdu.',
            'password.required' => 'Lūdzu, ievadiet Jūsu paroli.',
        ]);

        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            $errorMessage = implode("\n", $errorMessages);
            throw ValidationException::withMessages([$errorMessage]);
        }
        $user = User::where('username', '=', $request->username)->first();
        if (!$user) {
            return response()->json(['message' => 'Lietotājs nav atrasts!'], 500);
        }
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Nepareizā parole'],
            ]);
        }
        return response()->json(['message' => 'Lietotājs atrasts!', 'data' => $user]);
    }

}
