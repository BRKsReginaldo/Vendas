<?php

namespace App\Providers;

use App\Client;
use App\Customer;
use App\PaymentType;
use App\Policies\ClientPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\PaymentTypePolicy;
use App\Policies\ProviderPolicy;
use App\Policies\UserPolicy;
use App\Provider;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Client::class => ClientPolicy::class,
        Customer::class => CustomerPolicy::class,
        Provider::class => ProviderPolicy::class,
        PaymentType::class => PaymentTypePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerMacros();

        Passport::routes();
    }

    public function registerMacros()
    {
        $this->getModelMacro();
    }

    public function getModelMacro()
    {
        FormRequest::macro('getModel', function($key, $class) {
            $model = $this->route($key);
            return $model instanceof $class ? $model : resolve($class)->findOrFail($model);
        });
    }
}
