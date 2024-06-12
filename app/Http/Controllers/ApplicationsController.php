<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index()
    {
        return Applications::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'date' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'comments' => 'nullable',
            'vacancy' => 'required'
        ]);
        $application = new Applications;
        $application->name = $request->name;
        $application->surname = $request->surname;
        $application->phone = $request->phone;
        $application->email = $request->email;
        $application->birth_date = $request->date;
        $application->comments = $request->comments;
        $application->vacancy = $request->vacancy;
        $application->save();
        return response()->json(['message' => 'Your application has been sent!', 'data' => $application]);
    }

    public function changeStatus(string $id, Request $request){
        $application = Applications::find($id);
        if($application){
            $application->status = $request->status;
            $application->save();
            return response()->json(['message' => 'Status has been changed!', 'data' => $application]);
        }
        return response()->json(['message' => 'Application was not found!'], 500);
    }
}
