<?php

namespace Tests\Feature\User;


use App\User;
use Tests\DatabaseActiveTest;

abstract class UserTest extends DatabaseActiveTest
{

    /**
     *  Get the api resource for the test
     */
    function apiResource(): string
    {
        return 'users';
    }

    /**
     * @param array $attributes
     * @param integer $times
     * @return mixed
     */
    public function makeUser()
    {
        return make(User::class, func_get_args());
    }
}