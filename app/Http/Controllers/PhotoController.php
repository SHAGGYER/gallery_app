<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    public function download($id)
    {
        $photo = Photo::find($id);

        return Storage::download($photo->path);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = Storage::disk('local')->putFileAs('photos', $request->file('items'), $request->file('items')->getClientOriginalName());

        $photo = new Photo();
        $photo->album_id = $request->album_id;
        $photo->caption = $request->caption;
        $photo->path = $path;
        $photo->extension = $request->file('items')->getClientOriginalExtension();
        $photo->mime = $request->file('items')->getMimeType();
        $photo->file_name = str_random(32);
        $photo->save();

        return response()->json($photo, 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        $photo->caption = $request->caption;
        $photo->save();

        return response()->json(true, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();

        return response()->json(true, 200);

    }
}
