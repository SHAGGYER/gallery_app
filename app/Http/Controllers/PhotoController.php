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
        $ext = $request->file('items')->getClientOriginalExtension();
        $filename = str_random(32).'.'.$ext;
        $file = $request->file('items');
        $path = Storage::disk('local')->putFileAs('public/images/photos', $file, $filename);

        $photo = new Photo();
        $photo->album_id = $request->album_id;
        $photo->caption = $request->caption;
        $photo->extension = $request->file('items')->getClientOriginalExtension();
        $photo->path = $path.'.'.$photo->extension;
        $photo->mime = $request->file('items')->getMimeType();
        $photo->file_name = $filename;
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
