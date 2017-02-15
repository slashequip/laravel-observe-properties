<?php
namespace HaganJones\LaravelObserveProperties\Tests\App\Providers;

use HaganJones\LaravelObserveProperties\Tests\App\Observers\UserObserver;
use HaganJones\LaravelObserveProperties\Tests\App\User;
use Illuminate\Support\ServiceProvider;

class TestingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        User::observe(UserObserver::class);

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {
        //
    }
}