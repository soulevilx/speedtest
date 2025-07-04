<?php

namespace App\Events;

use App\Entities\SpeedtestEntity;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BeforeSavingSpeedtest
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private readonly SpeedtestEntity $speedtest)
    {
        //
    }
}
