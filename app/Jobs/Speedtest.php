<?php

namespace App\Jobs;

use App\Services\Speedtest\SpeedtestService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class Speedtest implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly bool $save)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(SpeedtestService $service): void
    {
        $result = $service->speedtest();

        if ($this->save) {
            $service->save($result);
        }
    }
}
