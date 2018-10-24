<?php

namespace App\Repositories;


use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository
{
    protected $model = Product::class;

    public function create(array $data)
    {
        $product = parent::create($data);

        if (isset($data['image']) && !is_null($data['image'])) {
            $product->image()
                ->create([
                    'path' => basename(uploadFile($data['image']))
                ]);
        }

        return $product;
    }

    public function updateByModel(Model $model, array $data)
    {
        if (isset($data['image']) && !is_null($data['image'])) {
            $basename = basename(uploadFile($data['image']));
            if (!$model->image()->first()) {
                $model->image()->create([
                    'path' => $basename
                ]);
            } else {
                $model->image()->update([
                    'path' => $basename
                ]);
            }
        }

        return parent::updateByModel($model, $data);
    }
}