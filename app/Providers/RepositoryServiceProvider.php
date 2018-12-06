<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\UsersRepository::class, \App\Repositories\Eloquent\UsersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\AdminGroupRepository::class, \App\Repositories\Eloquent\AdminGroupRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\AdminUserRepository::class, \App\Repositories\Eloquent\AdminUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\AdminRuleRepository::class, \App\Repositories\Eloquent\AdminRuleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\AdminLogRepository::class, \App\Repositories\Eloquent\AdminLogRepositoryEloquent::class);
        //:end-bindings:
    }
}
