<?php

namespace App\Providers;

use App\Repository\Product\Eloquent\ProductRepository;
use App\Repository\User\Eloquent\UserRepository;
use App\Repository\Product\Interfaces\ProductInterface;
use App\Repository\User\Interfaces\UserInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
