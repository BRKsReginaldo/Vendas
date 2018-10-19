<?php

namespace App\Services;


use App\Image;

trait Imageable
{
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getImageAttribute()
    {
        return $this->image()->first()->path;
    }
}