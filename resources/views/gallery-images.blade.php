@extends('layouts.app')

@section('content')

<div class="container">
    <a href="/">Back</a>
        @if(Session::has('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{Session::get('message')}}</strong>
            </div>
         @endif
         <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addImage">
                    Add Image<b>(s)</b>
                </button>
            </div>
         </div>
    <h1 class="text-center">{{ $albums->name}}<b>({{$albums->images->count()}})</b></h1> 
    <div class="row">
        @if($albums->images->count() > 0) 
            @foreach($albums->images as $album) {{-- fetch data using relatrionship $albums->images --}}
            <div class="col-sm-4 col-md-4 d-block mx-auto">
                <div class="item">
                    <img src="{{ asset('storage/'.$album->name) }}" alt="" class="img-fluid img-thumbnail">
                </div>
               
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    Delete
                </button>

                <!-- Delete Image Modal Confirmation -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Image Confimation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <b>Are you sure you want to delete this Image?</b>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <form action="{{ $album->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                
                                <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>       
            @endforeach
            @else 
                  <div class="col-sm-12 col-md-6 d-block mx-auto">
                    <h1 class="bg-dark text-center p-3 mt-3 text-white rounded">
                        {{"No Image/s Available"}}
                    </h1>
                </div>
            @endif
        </div> 
</div>

                   <!-- Add Images Modal -->
<div class="modal fade" id="addImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Album Name:&nbsp;<b>{{ $albums->name }}</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">

            <div class="card">
               <form action="{{ route('album.image') }}" method="POST" enctype="multipart/form-data"
                  id="form_multiple_img">
               @csrf
               {{-- Show Success Message --}}
               <div class="card-body">
                     <div class="success_msg"></div>
                    <div id="error_msg"></div>
                  <div class="form-group mt-3">
                    <input type="hidden" name="album_id" value="{{ $albums->id }}" class="form-control">
                  </div>
                  {{-- Add image --}}
                  <label class="font-weight-bold">Upload Image(s)</label>
                  <div class="input-group control-group add-img">
                     <input type="file" name="image[]" class="form-control">
                     <div class="input-group-btn">
                        <button class="btn btn-success btn-add-image font-weight-bold" type="button">
                        &plus;
                        </button>
                     </div>
                  </div>
                  {{-- Multiply the upload image form --}}
                  <div class="copy_form d-none">
                     <div class="input-group control-group add-more-img mt-3">
                        <input type="file" name="image[]" class="form-control" id="image">
                        <div class="input-group-btn">
                           <button class="btn btn-danger btn-remove-image font-weight-bold" type="button">
                           &#9747;
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mt-3 d-flex justify-content-end">
                     <button class="btn btn-primary upload-image">Upload</button>
                  </div>
               </div>
            </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection