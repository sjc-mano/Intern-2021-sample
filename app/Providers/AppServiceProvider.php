<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\EncryptService;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('EncryptService', EncryptService::class);
        $this->app->bind('UserService', UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
