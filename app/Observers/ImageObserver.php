<?php

namespace App\Observers;


use App\Image;

trait ImageObserver
{
    public function creating(Image $image)
    {
        $image->setAttribute('path', uploadFile($image->path));
    }
}