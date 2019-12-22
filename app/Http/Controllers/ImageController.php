<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Album;

class ImageController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $images = Image::get();
        return view('home',compact('images'));
    }

    public function store(Request $request) {
        //Create album name 
        $album = Album::create(['name' => $request->get('album_name')]);

        //Loop all the image[] as array
        if($request->hasFile('image')) {
            foreach($request->file('image') as $image) {
                $path = $image->store('uploads','public');
                Image::create([
                    'name' => $path,
                    'album_id' => $album->id //Get the last inserted id in album class
                ]);
            }   
        }
        return redirect('/album')->with('success','Album Successfully Created');
    }
}
