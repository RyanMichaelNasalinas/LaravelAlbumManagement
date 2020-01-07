<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Album;
use Image as InterventionImage;

class ImageController extends Controller
{

    public function __construct() {
        $this->middleware('admin',
            ['only' => ['index','addImage','store','destroy','albumCover']
        ]);
    }
    //Show all albums
    public function album() {
        $albums = Album::with('images')->get();
        return view('gallery',compact('albums'));
    }

    public function index() {
        $images = Image::get();
        return view('home',compact('images'));
    }

    public function show($id) {
        $albums = Album::findOrFail($id);
        return view('gallery-images',compact('albums'));
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
                $filename = time().'.'.$image->getClientOriginalExtension();
                InterventionImage::make($image)->fit(600,600)->save('storage/uploads'.$filename);
                Image::create([
                    'name' =>  $filename ,
                    'album_id' => $album->id //Get the last inserted id in album class
                ]);
            }   
        }
        return '<div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>Succesfully Uploaded Album</strong>
                </div>';
    }

    public function destroy($id) {
        $image = Image::findOrFail($id);
        $filename = $image->name;
        $image->delete();
        \Storage::delete('public/'.$filename);
        return  redirect()->back()->with('message','Image Deleted Successfully');
    }

    public function addImage(Request $request) {
          $this->validate($request,[
            'image' => 'required'
        ]);
        $album_id = request('album_id');
        //Loop all the image[] as array
        if($request->hasFile('image')) {
            foreach($request->file('image') as $image) {
                // $path = $image->store('uploads','public');
                $filename = time().'.'.$image->getClientOriginalExtension();
                InterventionImage::make($image)->fit(600,600)->save('storage/uploads'.$filename);
                Image::create([
                    'name' => $filename,
                    'album_id' => $album_id  //Get the value of the hiddend input id
                ]);
            }        
        }
        return redirect()->back()->with('message','Image Added Successfully');
    }

    public function albumCover(Request $request) {
            $this->validate($request,[
                'image' => 'required'
            ]);
            $album_id = request('album_id');
            if($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    InterventionImage::make($image)->fit(600, 600)->save('storage/uploads' . $filename);
                    Album::where('id',$album_id)->update([
                        'image' => $filename
                ]);
            }
        return redirect()->back()->with('message','Image Updated Successfully');    
    }
}
