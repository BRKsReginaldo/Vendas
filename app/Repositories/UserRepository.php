<?php

namespace App\Repositories;


use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    protected $model = User::class;

    public function getSortFields()
    {
        return ['name', 'email', 'phone'];
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = parent::create($data);

        $user->image()->create([
            'path' => isset($data['image']) && !is_null($data['image']) ? basename(uploadFile($data['image'])) : 'avatar.png'
        ]);

        return $user;
    }

    public function updateByModel(Model $model, array $data)
    {
        if (isset($data['password']) && !is_null($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        if (isset($data['image']) && !is_null($data['image'])) {
            $basename = basename(uploadFile($data['image']));
            if (!$model->image()->first()) {
                $model->image()->create([
                    'path' => $basename
                ]);
            } else {
                $model->image()->update([
                    'path' => $basename
                ]);
            }
        }

        $data['name'] = $data['name'] ?? $model->name;
        $data['email'] = $data['email'] ?? $model->email;
        $data['password'] = $data['password'] ?: $model->password;

        return parent::updateByModel($model, $data);
    }
}