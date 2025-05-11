<?php

namespace App\Services\Speedtest;

use App\Entities\SpeedtestEntity;
use App\Events\AfterSpeedtestSaved;
use App\Events\BeforeSavingSpeedtest;
use App\Models\Speedtest;
use App\Repositories\SpeedtestRepository;
use App\Services\Speedtest\Interfaces\ISpeedtestExecutor;
use Exception;
use Illuminate\Support\Facades\Event;

readonly class SpeedtestService
{
    public const FORMAT = 'json';

    public const SERVER_ID = null;

    protected SpeedtestEntity $speedtest;

    public function __construct(
        private ISpeedtestExecutor $executor
    ) {
    }

    public function speedtest(
        string $format = self::FORMAT,
        ?int $serverId = self::SERVER_ID,
    ): self {
        $this->speedtest = new SpeedtestEntity(json_decode(
            $this->executor->execute($format, $serverId)
        ));

        return $this;
    }

    /**
     * @throws Exception
     */
    public function save(): Speedtest
    {
        if (! isset($this->speedtest)) {
            throw new Exception('Speedtest not saved');
        }

        return app(SpeedtestRepository::class)->create($this->speedtest);
    }

    public function getResult(): SpeedtestEntity
    {
        return $this->speedtest;
    }
}
