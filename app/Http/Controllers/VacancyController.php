<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    //
    public function index()
    {
        // return Vacancy::where('id', $id)->get();
        return Vacancy::all();
    }
    public function getThree()
    {
        //return newest three 
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

            return response()->json(['message' => 'Image uploaded successfully!', 'data' => $vac]);
        }
        // // $image = $request->file('image_data');
        // // $filename = time() . '.' . $image->getClientOriginalExtension();

        // // $imageBlob = file_get_contents($image->getRealPath()); // Read image data
        // // $mimeType = $image->getClientMimeType();

        // // $newImage = Vacancy::create([
        // //     'title' => $request->title,
        // //     'company' => $request->company,
        // //     'time' => $request->time,
        // //     'salary' => $request->salary,
        // //     'location' => $request->location,
        // //     'description' => $request->description,
        // //     'contacts' => $request->contacts,
        // //     'image_data' => $imageBlob,
        // // ]);

        // $path = $request->file('image_data')->getRealPath();
        // $image = file_get_contents($path);
        // $base64 = base64_encode($image);


        // $new = new Vacancy;
        // $new->image_data = $base64;
        // $new->save();



    }


    public function getSingle(string $id)
    {
        return Vacancy::where('id', $id)->get();
    }


}
