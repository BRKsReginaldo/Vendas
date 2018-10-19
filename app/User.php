<?php

namespace App;

use App\Services\BelongsToClient;
use App\Services\Imageable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens, BelongsToClient, Imageable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'client_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->using(RoleUser::class);
    }

    public function assignRole($role)
    {
        return $this->roles()->attach(Role::where('name', $role)->first()->getKey());
    }

    public function removeRole($role)
    {
        return $this->roles()->detach(Role::where('name', $role)->first()->getKey());
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function productTransactions()
    {
        return $this->hasMany(ProductTransaction::class);
    }

    public function productBuys()
    {
        return $this->hasMany(ProductBuy::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function panels()
    {
        return $this->hasMany(Panel::class);
    }
}
