<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){
        return User::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        $user = new User;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            return response()->json(['message' => 'User created successfully!', 'data' => $user]);
    }

    public function delete(string $id){
        $user = User::find($id);
        $user->delete();
    }

    public function update(string $id, Request $request){
        $request->validate([
            'username' => 'required',
            'oldpassword' => 'nullable',
            'newpassword' => 'nullable',
            'role' => 'required',
        ]);
        $user = User::find($id);
            $user->username = $request->username;
            $user->role = $request->role;
            if($request->oldpassword != null && $request->newpassword != null){
                if(Hash::check($request->oldpassword, $user->password)){
                    $user->password = $request->newpassword;
                }else{
                    return response()->json(['error' => 'Old password is incorrect!', 'data' => $user]);
                }
            }
            $user->save();
            return response()->json(['message' => 'User updated successfully!', 'data' => $user]);
    }
    }