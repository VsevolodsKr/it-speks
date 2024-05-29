<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    //
    public function index()
    {
        return Vacancy::all();
    }
    public function getThree()
    {
        return Vacancy::orderBy('created_at', 'desc')->take(3)->get();
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'time' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'description' => 'required',
            'contacts' => 'required',
            'file' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $vac = new Vacancy;
        if ($request->file()) {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');


            $vac->title = $request->title;
            $vac->company = $request->company;
            $vac->time = $request->time;
            $vac->salary = $request->salary;
            $vac->location = $request->location;
            $vac->description = $request->description;
            $vac->contacts = $request->contacts;
            $vac->image_title = $file_name;
            $vac->image_path = '/storage/app/public/' . $file_path;
            $vac->save();

            return response()->json(['message' => 'Vacancy created successfully!', 'data' => $vac]);
        }
    }


    public function getSingle(string $id)
    {
        return Vacancy::find($id);
    }

    public function update(Request $request, string $id)
    {

        // $vac = Vacancy::where('id', $id)->get();
        $vac = Vacancy::find($id);

        if (isset($request->image_path)) {
            $vac->image_path = $request->image_path;
        } else {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
            $vac->image_title = $file_name;
            $vac->image_path = '/storage/app/public/' . $file_path;
        }

        $vac->title = $request->title;
        $vac->company = $request->company;
        $vac->time = $request->time;
        $vac->salary = $request->salary;
        $vac->location = $request->location;
        $vac->description = $request->description;
        $vac->contacts = $request->contacts;
        $vac->save();

        return response()->json(['message' => 'Updated successfully!', 'data' => $vac]);
    }
}
