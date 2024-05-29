<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function index()
    {
        return News::orderBy('created_at', 'desc')->get();
    }
    public function getThree()
    {
        return News::orderBy('created_at', 'desc')->take(3)->get();
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $vac = new News;
        if ($request->file()) {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $vac->title = $request->title;
            $vac->short_desc = $request->short_desc;
            $vac->description = $request->description;
            $vac->image_path = '/storage/app/public/' . $file_path;
            $vac->save();

            return response()->json(['message' => 'News created successfully!', 'data' => $vac]);
        }
    }


    public function getSingle(string $id)
    {
        return News::find($id);
    }

    public function update(Request $request, string $id)
    {

        $vac = News::find($id);

        if (isset($request->image_path)) {
            $vac->image_path = $request->image_path;
        } else {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $vac->image_path = '/storage/app/public/' . $file_path;
        }

        $vac->title = $request->title;
        $vac->short_desc = $request->short_desc;
        $vac->description = $request->description;
        $vac->save();

        return response()->json(['message' => 'Updated successfully!', 'data' => $vac]);
    }

    public function delete(string $id)
    {
        $vac = News::find($id);
        $vac->delete();
    }
}
