<?php

namespace App\Observers;


use App\Client;

class ClientObserver
{
    public function created(Client $client)
    {
        $client->creator->update([
            'client_id' => $client->id
        ]);
    }
}