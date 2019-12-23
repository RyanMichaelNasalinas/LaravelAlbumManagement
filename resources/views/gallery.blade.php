@extends('layouts.app')

@section('content')

<div class="container">
    @if(Session::has('message'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{Session::get('message')}}</strong>
        </div>
    @endif
    <div class="row">
        @foreach($albums as $album)
        <div class="col-sm-4 col-md-4 d-block mx-auto">
            <div class="item">
                <a href="albums/{{ $album->id }}">
                    <img src="{{ asset('images/Bone.jpg') }}" alt="" class="img-fluid img-thumbnail">
                </a>
                <a href="albums/{{ $album->id }}" class="centered">{{ $album->name }}</a>
            </div>        
        </div>
        @endforeach
    </div>
</div>

@endsection