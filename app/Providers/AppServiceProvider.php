<?php

namespace App\Providers;

use App\Services\ClassService;
use App\Services\ClassServiceContract;
use App\Services\DashboardService;
use App\Services\DashboardServiceContract;
use App\Services\StudentService;
use App\Services\StudentServiceContract;
use App\Services\UserService;
use App\Services\UserServiceContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(DashboardServiceContract::class, DashboardService::class);
        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(ClassServiceContract::class, ClassService::class);
        $this->app->bind(StudentServiceContract::class, StudentService::class);
    }
}
