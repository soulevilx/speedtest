<?php

namespace App\Services\Speedtest;

use App\Events\AfterSpeedtestSaved;
use App\Events\BeforeSavingSpeedtest;
use App\Models\Speedtest;
use App\Services\Speedtest\Entities\SpeedtestEntity;
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
        $result = $this->executor->execute(
            $format,
            $serverId
        );

        return new SpeedtestEntity(json_decode($result));
    }

    public function save(
        SpeedtestEntity $speedtest
    ): Speedtest {
        $result = $speedtest->toArray();

        $result['download_speed'] = $result['download']['bandwidth'];
        $result['upload_speed'] = $result['upload']['bandwidth'];
        $result['internal_ip'] = $result['interface']['internalIp'];
        $result['external_ip'] = $result['interface']['externalIp'];

        Event::dispatch(new BeforeSavingSpeedtest($result));

        $speedtest = Speedtest::create($result);

        Event::dispatch(new AfterSpeedtestSaved($speedtest));

        return $speedtest;
    }
}
