<?php

namespace Tests\Unit\Services;

use App\Services\SpeedtestService;
use Tests\TestCase;

class SpeedtestServiceTest extends TestCase
{
    public function testSpeedtest()
    {
        dd(app(SpeedtestService::class)->speedtest());
    }
}
