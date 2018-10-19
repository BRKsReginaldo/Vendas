<?php

namespace App\Repositories;


use App\User;

class UserRepository extends BaseRepository
{
    protected $model = User::class;

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = parent::create($data);

        $user->image()->create([
            'path' => basename(uploadFile($data['image']))
        ]);

        return $user;
    }
}