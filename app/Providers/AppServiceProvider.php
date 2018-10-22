<?php

namespace App\Providers;

use App\Services\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (app()->environment() !== 'production') {
            \DB::listen(function($sql) {
               \Log::info([$sql->sql, $sql->bindings, $sql->time]);
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('api', Api::class);
        $this->app->singleton('OAUTH_PASSWORD_CLIENT', function() {
            return DB::table('oauth_clients')->where('name', 'Laravel Password Grant Client')->first(['id', 'secret']);
        });
    }
}
