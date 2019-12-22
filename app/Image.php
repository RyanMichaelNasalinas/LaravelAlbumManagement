<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Image extends Model
{
    protected $fillable = ['name','album_id'];

    public function images() {
        return $this->hasMany(Image::class);
    }
}
