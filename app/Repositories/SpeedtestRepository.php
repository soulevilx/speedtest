<?php

namespace App\Repositories;

use App\Entities\SpeedtestEntity;
use App\Events\AfterSpeedtestSaved;
use App\Events\BeforeSavingSpeedtest;
use App\Models\Speedtest;
use Illuminate\Support\Facades\Event;

class SpeedtestRepository
{
    public function create(SpeedtestEntity $speedtest): Speedtest
    {
        Event::dispatch(new BeforeSavingSpeedtest($speedtest));

        $model = Speedtest::create($speedtest->toArray());

        Event::dispatch(new AfterSpeedtestSaved($speedtest));

        return $model;
    }
}
