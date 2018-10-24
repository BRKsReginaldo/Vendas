<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Http\Requests\Product\RestoreProductRequest;
use App\Http\Requests\Product\ShowProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\ViewProductRequest;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewProductRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ViewProductRequest $request)
    {
        return ProductResource::collection(
            $this->productRepository->getAll(
                $request->per_page ?? 20,
                true,
                sortedQuery($this->productRepository, $request, 'name')
            )
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewProductRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function trashed(ViewProductRequest $request)
    {
        return ProductResource::collection(
            $this->productRepository->getAll(
                $request->per_page ?? 20,
                true,
                sortedQuery($this->productRepository, $request, 'name')
                    ->withTrashed()
                    ->whereNotNull('deleted_at')
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return ProductResource
     */
    public function store(CreateProductRequest $request)
    {
        return new ProductResource($this->productRepository->create($request->only([
            'provider_id',
            'client_id',
            'name',
            'description',
            'buy_price',
            'sell_price',
        ])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @param ShowProductRequest $request
     * @return ProductResource
     */
    public function show(Product $product, ShowProductRequest $request)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param  \App\Product $product
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        return new ProductResource($this->productRepository->updateByModel($product, $request->only([
            'provider_id',
            'client_id',
            'name',
            'description',
            'buy_price',
            'sell_price',
        ])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @param DeleteProductRequest $request
     * @return void
     * @throws \Exception
     */
    public function destroy(Product $product, DeleteProductRequest $request)
    {
        if (!$this->productRepository->deleteByModel($product)) abort(500);

        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $product
     * @param RestoreProductRequest $request
     * @return void
     */
    public function restore($product, RestoreProductRequest $request)
    {
        if (!$this->productRepository->restoreById($product)) abort(500);

        return response('', 200);
    }
}
