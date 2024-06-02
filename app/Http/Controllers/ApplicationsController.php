<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index(){
        return Applications::orderBy('created_at', 'desc')->get();
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'comments' => 'nullable'
        ]);
        $application = new Applications;
        $application->name = $request->name;
        $application->surname = $request->surname;
        $application->phone = $request->phone;
        $application->email = $request->email;
        $application->comments = $request->comments;
        $application->status = 0;
        $application->save();
        return response()->json(['message' => 'Your application has been sended!', 'data' => $application]);
    }
}
