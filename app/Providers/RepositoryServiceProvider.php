<?php

namespace App\Providers;

use Domains\Order\Repositories\OrderRepository;
use Domains\Order\Repositories\OrderRepositoryInterface;
use Domains\User\Repositories\UserRepository;
use Domains\User\Repositories\UserRepositoryInterface;
use Domains\Worker\Repositories\WorkerRepository;
use Domains\Worker\Repositories\WorkerRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(WorkerRepositoryInterface::class, WorkerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
