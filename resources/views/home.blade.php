@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="success_msg">
                </div>
                <div id="error_msg"></div>

            <div class="card">
                <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data"
                id="form_upload_img">
                @csrf
                    {{-- Show Success Message --}}
        
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Album Name</label>
                        <input type="text" name="album_name" id="" class="form-control">
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
           </div>
           </form>
        </div>
    </div>    
</div>
@endsection
