<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Logout;
use App\Listeners\UpdateUserStatusOnLogin;
use App\Listeners\UpdateUserStatusOnLogout;
use App\Interfaces\HorarioServiceInterface;
use App\Services\HorarioService;
use Illuminate\Support\ServiceProvide;

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
        $this->app->bind(HorarioServiceInterface::class, HorarioService::class);
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
