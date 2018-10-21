<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageFacade;
use App\Image;

class ImageRepository extends BaseRepository
{
    protected $model = Image::class;

    public function urlForSize($image, $width = 40, $height = 40)
    {
        $imageOnSize = "{$width}x{$height}_" . $image;

        try {
            if (!Storage::disk('public')->exists($imageOnSize)) {
                $img = ImageFacade::make(public_path('storage/' . $image))->fit($width, $height, function($constraint) {
                    $constraint->upsize();
                });
                $img->save(public_path('storage/' . $imageOnSize));
            }
        } catch(\Exception $exception) {
            return '';
        }

        return $imageOnSize;

    }
}