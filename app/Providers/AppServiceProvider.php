<?php

namespace App\Providers;

use App\Services\Speedtest\Executors\SpeedtestExecutor;
use App\Services\Speedtest\Interfaces\ISpeedtestExecutor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(ISpeedtestExecutor::class, function () {
            return new SpeedtestExecutor;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
