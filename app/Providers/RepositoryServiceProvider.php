<?php

namespace CodeDelivery\Providers;

use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'CodeDelivery\Respositories\CategoryRepository',
            'CodeDelivery\Respositories\CategoryRepositoryEloquent'
        );
    }
}
