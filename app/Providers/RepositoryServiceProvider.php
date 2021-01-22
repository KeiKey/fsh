<?php

namespace App\Providers;

use App\Repository\Classes\FileRepository;
use App\Repository\Classes\ShareRepository;
use App\Repository\Classes\UserRepository;
use App\Repository\Contracts\FileRepositoryInterface;
use App\Repository\Contracts\ShareRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            FileRepositoryInterface::class,
            FileRepository::class
        );

        $this->app->bind(
            ShareRepositoryInterface::class,
            ShareRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
