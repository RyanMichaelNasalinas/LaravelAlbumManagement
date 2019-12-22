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
        //Validate form
        $this->validate($request,[
            'album_name' => 'required|min:3|max:50',
            'image' => 'required'
        ]);
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
        return ' <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>Succesfully Uploaded Album</strong>
                    </div>';
    }
}
