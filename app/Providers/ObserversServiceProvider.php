<?php

namespace App\Providers;

use App\Image;
use App\Observers\ImageObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    protected $observers = [
        Image::class => [
            ImageObserver::class
        ],
        User::class => [
            UserObserver::class,
        ]
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootObservers();
    }

    /**
     * Setup all model observers
     */
    public function bootObservers()
    {
        foreach ($this->observers as $class => $observer) {
            $this->bootObserver($class, $observer);
        }
    }

    public function bootObserver($class, $observer)
    {
        if (is_array($observer)) {
            foreach ($observer as $obs) {
                $this->bootObserver($class, $obs);
            }

            return;
        }

        resolve($class)->observe($observer);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
