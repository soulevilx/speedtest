<?php

namespace App\Services\Speedtest;

use App\Entities\SpeedtestEntity;
use App\Events\AfterSpeedtestSaved;
use App\Events\BeforeSavingSpeedtest;
use App\Models\Speedtest;
use App\Services\Speedtest\Interfaces\ISpeedtestExecutor;
use Illuminate\Support\Facades\Event;

readonly class SpeedtestService
{
    public function __construct(
        private ISpeedtestExecutor $executor
    ) {
    }

    public function speedtest(
        string $format = 'json',
        ?int $serverId = null,
    ): SpeedtestEntity {
        return new SpeedtestEntity(json_decode(
            $this->executor->execute($format, $serverId)
        ));
    }

    public function save(
        SpeedtestEntity $speedtest
    ): Speedtest {

        $result = $speedtest->toArray();

        Event::dispatch(new BeforeSavingSpeedtest($result));

        $speedtest = Speedtest::create($result);

        Event::dispatch(new AfterSpeedtestSaved($speedtest));

        return $speedtest;
    }
}
