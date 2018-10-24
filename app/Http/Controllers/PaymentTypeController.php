<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentType\CreatePaymentTypeRequest;
use App\Http\Requests\PaymentType\DeletePaymentTypeRequest;
use App\Http\Requests\PaymentType\RestorePaymentTypeRequest;
use App\Http\Requests\PaymentType\ShowPaymentTypeRequest;
use App\Http\Requests\PaymentType\UpdatePaymentTypeRequest;
use App\Http\Requests\PaymentType\ViewPaymentTypeRequest;
use App\Http\Resources\PaymentTypeResource;
use App\PaymentType;
use App\Repositories\PaymentTypeRepository;

class PaymentTypeController extends Controller
{
    protected $paymentTypeRepository;

    public function __construct(PaymentTypeRepository $paymentTypeRepository)
    {
        $this->middleware('auth');
        $this->paymentTypeRepository = $paymentTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewPaymentTypeRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ViewPaymentTypeRequest $request)
    {
        return PaymentTypeResource::collection(
            $this->paymentTypeRepository->getAll(
                $request->per_page ?? 20,
                true,
                sortedQuery($this->paymentTypeRepository, $request, 'name')
            )
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewPaymentTypeRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function trashed(ViewPaymentTypeRequest $request)
    {
        return PaymentTypeResource::collection(
            $this->paymentTypeRepository->getAll(
                $request->per_page ?? 20,
                true,
                sortedQuery($this->paymentTypeRepository, $request, 'name')
                ->withTrashed()
                ->whereNotNull('deleted_at')
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePaymentTypeRequest $request
     * @return PaymentTypeResource
     */
    public function store(CreatePaymentTypeRequest $request)
    {
        return new PaymentTypeResource($this->paymentTypeRepository->create($request->only([
            'name',
            'client_id'
        ])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentType $payment_type
     * @param ShowPaymentTypeRequest $request
     * @return PaymentTypeResource
     */
    public function show(PaymentType $payment_type, ShowPaymentTypeRequest $request)
    {
        return new PaymentTypeResource($payment_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePaymentTypeRequest $request
     * @param  \App\PaymentType $payment_type
     * @return PaymentTypeResource
     */
    public function update(UpdatePaymentTypeRequest $request, PaymentType $payment_type)
    {
        return new PaymentTypeResource($this->paymentTypeRepository->updateByModel($payment_type, $request->only([
            'client_id',
            'name'
        ])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentType $payment_type
     * @param DeletePaymentTypeRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(PaymentType $payment_type, DeletePaymentTypeRequest $request)
    {
        if (!$this->paymentTypeRepository->deleteByModel($payment_type)) abort(500);

        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentType $id
     * @param RestorePaymentTypeRequest $request
     * @return PaymentTypeResource
     */
    public function restore($id, RestorePaymentTypeRequest $request)
    {
        return new PaymentTypeResource($this->paymentTypeRepository->restoreById($id));
    }
}
