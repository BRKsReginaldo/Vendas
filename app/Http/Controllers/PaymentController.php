<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Http\Requests\Payment\ShowPaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->middleware('auth');
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        abort(500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePaymentRequest $request
     * @return PaymentResource
     */
    public function store(CreatePaymentRequest $request)
    {
        return new PaymentResource($this->paymentRepository->create($request->only([
            'client_id',
            'original_price',
            'discount',
            'discount_percentage',
            'price',
            'payment_type_id',
            'total_plots',
            'pending_plots',
            'paid_plots',
            'payed_at',
            'payable_type',
            'payable_id',
        ])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment $payment
     * @param ShowPaymentRequest $request
     * @return PaymentResource
     */
    public function show(Payment $payment, ShowPaymentRequest $request)
    {
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePaymentRequest $request
     * @param  \App\Payment $payment
     * @return void
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        return new PaymentResource($this->paymentRepository->updateByModel($payment, $request->only([
            'pending_plots',
            'paid_plots',
            'payed_at'
        ])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment $payment
     * @return void
     */
    public function destroy(Payment $payment)
    {
        abort(500);
    }
}
