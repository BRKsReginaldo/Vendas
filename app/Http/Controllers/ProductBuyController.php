<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductBuy\CreateProductBuyRequest;
use App\Http\Requests\ProductBuy\DeleteProductBuyRequest;
use App\Http\Requests\ProductBuy\ShowProductBuyRequest;
use App\Http\Requests\ProductBuy\UpdateProductBuyRequest;
use App\Http\Requests\ProductBuy\ViewProductBuyRequest;
use App\Http\Resources\ProductBuyResource;
use App\ProductBuy;
use App\Repositories\ProductBuyRepository;
use Illuminate\Http\Request;

class ProductBuyController extends Controller
{
    protected $productBuyRepository;

    public function __construct(ProductBuyRepository $productBuyRepository)
    {
        $this->productBuyRepository = $productBuyRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewProductBuyRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ViewProductBuyRequest $request)
    {
        return ProductBuyResource::collection(
            $this->productBuyRepository->getAll(
                $request->per_page ?? 20,
                true,
                sortedQuery($this->productBuyRepository, $request, 'id')
            )
        );
    }

    public function trashed(ViewProductBuyRequest $request)
    {
        abort(500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductBuyRequest $request)
    {
        return new ProductBuyResource($this->productBuyRepository->create($request->only([
            'product_id',
            'observations',
            'client_id',
            'user_id',
            'amount'
        ])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductBuy $productBuy
     * @param ShowProductBuyRequest $request
     * @return void
     */
    public function show(ProductBuy $productBuy, ShowProductBuyRequest $request)
    {
        abort(500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductBuyRequest $request
     * @param  \App\ProductBuy $productBuy
     * @return void
     */
    public function update(UpdateProductBuyRequest $request, ProductBuy $productBuy)
    {
        abort(500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductBuy $productBuy
     * @param DeleteProductBuyRequest $request
     * @return void
     */
    public function destroy(ProductBuy $productBuy, DeleteProductBuyRequest $request)
    {
        abort(500);
    }

    public function restore($id)
    {
        abort(500);
    }
}
