@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
            @if(Auth::check() && Auth::user()->user_type == 'admin')
            <div class="ml-3">
                <a href="/album">Add Album</a>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                @if(Session::has('message'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{Session::get('message')}}</strong>
                    </div>
                @endif
            </div>
        </div>
</div>
<div class="container">
           <div class="row">
            @if($albums->count() > 0)
            @foreach($albums as $album)
                <div class="col-sm-4 col-md-4 d-block mx-auto"> 
                    <div class="item">
                        <a href="albums/{{ $album->id }}">
                            @if(empty($album->image))
                                <img src="{{ asset('images/coding.jpg') }}" alt="" class="img-fluid img-thumbnail">
                            @else
                                <img src="{{ asset('storage/'.$album->image) }}" alt="" class="img-fluid img-thumbnail"> 
                            @endif
                        </a>
                        <a href="albums/{{ $album->id }}" class="centered">{{ $album->name }}</a>
                    </div>
               
                @if(Auth::check() && Auth::user()->user_type == 'admin')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#album_pic{{ $album->id }}">
                    Change Album Image
                </button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="album_pic{{ $album->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route("album.image.cover") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control">
                                        <input type="hidden" name="album_id" value="{{$album->id}}">
                                    </div>
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
             </div>
            @endforeach
            @else
                    <div class="col-md-12 text-center mx-auto mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h1>No album<b>(s)</b> available</h1>
                                <a href="/album" class="btn btn-primary mt-2">Upload</a>
                            </div>
                        </div>
                    </div>     
            </div>
           @endif
</div>
@endsection