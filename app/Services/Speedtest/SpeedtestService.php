<?php

namespace App\Services\Speedtest;

use App\Entities\SpeedtestEntity;
use App\Models\Speedtest;
use App\Repositories\SpeedtestRepository;
use App\Services\Process\Interfaces\IProcess;
use Exception;

readonly class SpeedtestService
{
    public const FORMAT = 'json';

    public const SERVER_ID = null;

    protected SpeedtestEntity $speedtest;

    public function __construct(
        private IProcess $executor
    ) {
    }

    /**
     * @throws Exception
     */
    public function speedtest(): self
    {
        if ($this->executor->execute()) {
            $this->speedtest = $this->executor->getOutput();

            $this->save($this->speedtest);
        }

        return $this;
    }

    /**
     * @throws Exception
     */
    public function save(SpeedtestEntity $speedtest): Speedtest
    {
        return app(SpeedtestRepository::class)
            ->create($speedtest);
    }

    public function getResult(): SpeedtestEntity
    {
        return $this->speedtest;
    }
}
