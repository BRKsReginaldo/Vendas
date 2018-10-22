<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\ShowCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Requests\Customer\ViewCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->middleware('auth');
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewCustomerRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ViewCustomerRequest $request)
    {
        return CustomerResource::collection($this->customerRepository->getAll($request->per_page ?? 20, true, sortedQuery($this->customerRepository, $request, 'name')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCustomerRequest $request
     * @return CustomerResource
     */
    public function store(CreateCustomerRequest $request)
    {
        return new CustomerResource($this->customerRepository->create($request->only([
            'name',
            'phone',
            'client_id',
            'user_id',
        ])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer $customer
     * @param ShowCustomerRequest $request
     * @return CustomerResource
     */
    public function show(Customer $customer, ShowCustomerRequest $request)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomerRequest $request
     * @param  \App\Customer $customer
     * @return CustomerResource
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        return new CustomerResource($this->customerRepository->updateByModel($customer, $request->only([
            'name',
            'phone',
            'client_id',
            'user_id',
        ])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
