<?php

namespace App\Services;


use App\Image;

trait Imageable
{
    abstract function defaultImage();

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getImageAttribute()
    {
        $image = $this->image()->first();
        return $image ? $image->path : $this->defaultImage();
    }
}