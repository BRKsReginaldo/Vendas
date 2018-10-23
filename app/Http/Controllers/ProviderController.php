<?php

namespace App\Http\Controllers;

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
        return ProviderResource::collection($this->providerRepository->getAll($request->per_page ?? 20, true,
            sortedQuery($this->providerRepository, $request, 'name')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        //
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
