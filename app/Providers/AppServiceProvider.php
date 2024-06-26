<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Logout;
use App\Listeners\UpdateUserStatusOnLogin;
use App\Listeners\UpdateUserStatusOnLogout;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        Authenticated::class => [
            UpdateUserStatusOnLogin::class,
        ],
        Logout::class => [
            UpdateUserStatusOnLogout::class,
        ],
    ];

    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Paginator::defaultView('vendor.pagination.custom-pagination');
    }
}
