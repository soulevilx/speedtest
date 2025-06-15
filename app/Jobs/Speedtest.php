<?php

namespace App\Jobs;

use App\Services\Speedtest\SpeedtestService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class Speedtest implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(SpeedtestService $service): void
    {
        $service->speedtest();
    }
}
