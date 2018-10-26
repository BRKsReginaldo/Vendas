<?php

namespace App\Repositories;


use App\Provider;

class ProviderRepository extends BaseRepository
{
    protected $model = Provider::class;

    public function getSortFields()
    {
        return ['name'];
    }
}