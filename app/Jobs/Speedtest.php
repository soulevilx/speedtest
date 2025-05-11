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
     * Create a new job instance.
     */
    public function __construct(private readonly bool $save)
    {
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(SpeedtestService $service): void
    {
        $service->speedtest();

        if ($this->save) {
            $service->save();
        }
    }
}
