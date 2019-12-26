@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
          @if($albums->count() > 0)
          <div class="ml-3">
            <a href="/album">Add Album</a>
          </div>
            @foreach($albums as $album)
                <div class="col-sm-4 col-md-4 d-block mx-auto"> 
                    <div class="item">
                        <a href="albums/{{ $album->id }}">
                            <img src="{{ asset('images/coding.jpg') }}" alt="" class="img-fluid img-thumbnail">
                        </a>
                        <a href="albums/{{ $album->id }}" class="centered">{{ $album->name }}</a>
                    </div>
                </div>
            @endforeach
           @else
                <div class="col-md-6 text-center mx-auto mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1>No album<b>(s)</b> available</h1>
                            <a href="/album" class="btn btn-primary mt-2">Upload</a>
                        </div>
                    </div>
                </div>     
           @endif
    </div>
</div>

@endsection