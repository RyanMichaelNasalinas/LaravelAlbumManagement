@extends('layouts.app')

@section('content')

<div class="container">
    <a href="/">Back</a>
        <h1 class="text-center">{{ $albums->name}}<b>({{$albums->images->count()}})</b></h1>    
    <div class="row">
        @if($albums->images->count() > 0) 
            @foreach($albums->images as $album) {{-- fetch data using relatrionship $albums->images --}}
            <div class="col-sm-4 col-md-4 d-block mx-auto">
                <div class="item">
                    <img src="{{ asset('storage/'.$album->name) }}" alt="" class="img-fluid img-thumbnail">
                </div>
                <form action="{{ $album->id }}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>       
            @endforeach
            @else 
                  <div class="col-sm-4 col-md-4 d-block mx-auto">
                    <h1 class="bg-dark text-center p-3 mt-3 text-white rounded">
                        {{"No Image Available"}}
                    </h1>
                </div>
            @endif
        </div> 
</div>

@endsection