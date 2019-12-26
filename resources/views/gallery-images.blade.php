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

@endsection