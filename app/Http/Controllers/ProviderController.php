<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Requests\Provider\ShowProviderRequest;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Http\Requests\Provider\ViewProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    protected $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->middleware('auth');
        $this->providerRepository = $providerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewProviderRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ViewProviderRequest $request)
    {
        return ProviderResource::collection(
            $this->providerRepository->getAll(
                $request->per_page ?? 20,
                true,
                sortedQuery($this->providerRepository, $request, 'name')
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProviderRequest $request
     * @return ProviderResource
     */
    public function store(CreateProviderRequest $request)
    {
        return new ProviderResource($this->providerRepository->create($request->only([
            'name',
            'client_id'
        ])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider $provider
     * @param ShowProviderRequest $request
     * @return ProviderResource
     */
    public function show(Provider $provider, ShowProviderRequest $request)
    {
        return new ProviderResource($provider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProviderRequest $request
     * @param  \App\Provider $provider
     * @return ProviderResource
     */
    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        return new ProviderResource($this->providerRepository->updateByModel($provider, $request->only([
            'client_id',
            'name'
        ])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
