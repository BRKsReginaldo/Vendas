<?php

namespace App\Repositories;


use App\PaymentType;

class PaymentTypeRepository extends BaseRepository
{
    protected $model = PaymentType::class;

    public function getSortFields()
    {
        return ['name'];
    }
}