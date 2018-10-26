<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Requests\Provider\DeleteProviderRequest;
use App\Http\Requests\Provider\RestoreProviderRequest;
use App\Http\Requests\Provider\ShowProviderRequest;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Http\Requests\Provider\ViewProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Provider;
use App\Repositories\ProviderRepository;

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
     * Display a listing of the resource.
     *
     * @param ViewProviderRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function trashed(ViewProviderRequest $request)
    {
        return ProviderResource::collection(
            $this->providerRepository->getAll(
                $request->per_page ?? 20,
                true,
                sortedQuery($this->providerRepository, $request, 'name')
                ->withTrashed()
                ->whereNotNull('deleted_at')
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
            'client_id',
            'observations'
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
            'name',
            'observations'
        ])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider $provider
     * @param DeleteProviderRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Provider $provider, DeleteProviderRequest $request)
    {
        if (!$this->providerRepository->deleteByModel($provider)) abort(500);

        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider $id
     * @param RestoreProviderRequest $request
     * @return ProviderResource
     */
    public function restore($id, RestoreProviderRequest $request)
    {
        return new ProviderResource($this->providerRepository->restoreById($id));
    }
}
