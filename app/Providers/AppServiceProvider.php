<?php

namespace App\Providers;

use App\Services\Process\Executors\SpeedtestExecutor;
use App\Services\Speedtest\SpeedtestService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(SpeedtestService::class, function () {
            return new SpeedtestService(
                new SpeedtestExecutor
            );
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
