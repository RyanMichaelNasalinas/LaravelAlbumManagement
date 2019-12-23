<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
      protected $fillable = ['name'];
      //Get All the images in album
      public function images() {
        return $this->hasMany(Image::class);
    }
}
