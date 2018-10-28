<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlotResource;
use App\Plot;
use App\Repositories\PlotRepository;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    protected $plotRepository;

    public function __construct(PlotRepository $plotRepository)
    {
        $this->plotRepository = $plotRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PlotResource::collection($this->plotRepository->getAll(12, false));
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
     * @param  \App\Plot $plot
     * @return \Illuminate\Http\Response
     */
    public function show(Plot $plot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Plot $plot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plot $plot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plot $plot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plot $plot)
    {
        //
    }
}
