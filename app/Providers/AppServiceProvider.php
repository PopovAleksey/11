<?php

namespace App\Providers;

use App\Interfaces\Models\User;
use App\Interfaces\Repositories\UserRepository;
use App\Interfaces\Services\DevelopmentService;
use App\Interfaces\Services\UserService;
use App\Services\Development;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindRepositories();
        $this->bindModels();
        $this->bindServices();
    }

    private function bindRepositories(): void
    {
        $this->app->bind(UserRepository::class, \App\Repositories\UserRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(User::class, \App\Models\User::class);
    }

    private function bindServices(): void
    {
        $this->app->bind(DevelopmentService::class, Development::class);

        $this->app->bind(UserService::class, \App\Services\User\UserService::class);
    }
}
