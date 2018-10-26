<?php

namespace App\Policies;

use App\User;
use App\ProductBuy;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductBuyPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if (is_null($user->client_id)) return false;
    }

    /**
     * Determine whether the user can view the product buy.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasRole('seller') && !is_null($user->client);
    }
    
    /**
     * Determine whether the user can show the product buy.
     *
     * @param  \App\User  $user
     * @param  \App\ProductBuy  $productBuy
     * @return mixed
     */
    public function show(User $user, ProductBuy $productBuy)
    {
        return $user->client_id === $productBuy->client_id;
    }

    /**
     * Determine whether the user can create product buys.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('seller') && !is_null($user->client);
    }

    /**
     * Determine whether the user can update the product buy.
     *
     * @param  \App\User  $user
     * @param  \App\ProductBuy  $productBuy
     * @return mixed
     */
    public function update(User $user, ProductBuy $productBuy)
    {
        return $user->client_id === $productBuy->client_id;
    }

    /**
     * Determine whether the user can delete the product buy.
     *
     * @param  \App\User  $user
     * @param  \App\ProductBuy  $productBuy
     * @return mixed
     */
    public function delete(User $user, ProductBuy $productBuy)
    {
        return $user->client_id === $productBuy->client_id;
    }

    /**
     * Determine whether the user can restore the product buy.
     *
     * @param  \App\User  $user
     * @param  \App\ProductBuy  $productBuy
     * @return mixed
     */
    public function restore(User $user, ProductBuy $productBuy)
    {
        return $user->client_id === $productBuy->client_id;
    }

    /**
     * Determine whether the user can permanently delete the product buy.
     *
     * @param  \App\User  $user
     * @param  \App\ProductBuy  $productBuy
     * @return mixed
     */
    public function forceDelete(User $user, ProductBuy $productBuy)
    {
        return false;
    }
}
