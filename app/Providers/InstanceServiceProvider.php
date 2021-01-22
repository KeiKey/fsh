<?php

namespace App\Providers;

use App\Repository\Classes\FileRepository;
use App\Services\FileService;
use Exception;
use Illuminate\Support\ServiceProvider;

class InstanceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws Exception
     */
    public function boot()
    {
        $this->app->instance(FileService::class,
            new FileService(
                new FileRepository($this->app)
            )
        );
    }
}
