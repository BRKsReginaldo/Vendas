<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
      'name',
      'formal_name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->using(RoleUser::class);
    }
}
