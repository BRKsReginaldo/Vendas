<?php

namespace App\Repositories;


use App\Client;

class ClientRepository extends BaseRepository
{
    protected $model = Client::class;

    public function create(array $data)
    {
        $client = parent::create($data);

        return $client;
    }

    public function disableByModel($model)
    {
        return $model->update([
            'active' => false
        ]);
    }

    public function enableById($id)
    {
        return $this->newQuery()
            ->withTrashed()
            ->find($id)
            ->update([
               'active' => true
            ]);
    }
}