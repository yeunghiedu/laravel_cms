<?php

namespace App\Modules\Core\Providers;

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
        $this->app->bind(\App\Modules\Core\Repositories\SysuserRepository::class, \App\Modules\Core\Repositories\SysuserRepositoryEloquent::class);
        $this->app->bind(\App\Modules\Core\Repositories\AccountRepository::class, \App\Modules\Core\Repositories\AccountRepositoryEloquent::class);
        //:end-bindings:
    }
}
