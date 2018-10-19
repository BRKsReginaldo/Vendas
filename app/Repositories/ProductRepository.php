<?php

namespace App\Repositories;


use App\Product;

class ProductRepository extends BaseRepository
{
    protected $model = Product::class;

    public function create(array $data)
    {
        $product = parent::create($data);

        $product->images()
            ->create([
               'path' => basename(uploadFile($data['image']))
            ]);

        return $product;
    }
}