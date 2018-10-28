<?php

namespace App\Repositories;


use App\Customer;

class CustomerRepository extends BaseRepository
{
    protected $model = Customer::class;

    public function getSortFields()
    {
        return ['name', 'phone'];
    }
}