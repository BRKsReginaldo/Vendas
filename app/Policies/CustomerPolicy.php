<?php

namespace App\Policies;

use App\User;
use App\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User $user
     * @param  \App\Customer $customer
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasRole('seller') && !is_null($user->client);
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\User $user
     * @param  \App\Customer $customer
     * @return mixed
     */
    public function show(User $user, Customer $customer)
    {
        return $user->client_id === $customer->client_id;
    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('seller') && !is_null($user->client);
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\User $user
     * @param  \App\Customer $customer
     * @return mixed
     */
    public function update(User $user, Customer $customer)
    {
        return $user->client_id === $customer->client_id;
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\User $user
     * @param  \App\Customer $customer
     * @return mixed
     */
    public function delete(User $user, Customer $customer)
    {
        return $user->client_id === $customer->client_id;
    }

    /**
     * Determine whether the user can restore the customer.
     *
     * @param  \App\User $user
     * @param  \App\Customer $customer
     * @return mixed
     */
    public function restore(User $user, Customer $customer)
    {
        return $user->client_id === $customer->client_id;
    }

    /**
     * Determine whether the user can permanently delete the customer.
     *
     * @param  \App\User $user
     * @param  \App\Customer $customer
     * @return mixed
     */
    public function forceDelete(User $user, Customer $customer)
    {
        return false;
    }
}
