<?php

namespace App\Policies;

use App\User;
use App\PaymentType;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentTypePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (is_null($user->client_id)) return false;
    }

    /**
     * Determine whether the user can view the payment type
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasRole('seller') && !is_null($user->client);
    }

    /**
     * Determine whether the user can view the payment type
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function show(User $user, PaymentType $paymentType)
    {
        return $user->client_id === $paymentType->client_id;
    }

    /**
     * Determine whether the user can create providers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('seller') && !is_null($user->client);
    }

    /**
     * Determine whether the user can update the payment type
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function update(User $user, PaymentType $paymentType)
    {
        return $user->client_id === $paymentType->client_id;
    }

    /**
     * Determine whether the user can delete the payment type
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function delete(User $user, PaymentType $paymentType)
    {
        return $user->client_id === $paymentType->client_id;
    }

    /**
     * Determine whether the user can restore the payment type
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function restore(User $user, PaymentType $paymentType)
    {
        return $user->client_id === $paymentType->client_id;
    }

    /**
     * Determine whether the user can permanently delete the payment type
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function forceDelete(User $user, PaymentType $paymentType)
    {
        return false;
    }
}
