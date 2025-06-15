<?php

namespace App\Services\Process\Executors;

use App\Entities\SpeedtestEntity;
use App\Services\Process\AbstractBaseProcess;

class SpeedtestExecutor extends AbstractBaseProcess
{
    protected array $command = [
        'speedtest',
        '--format=json',
    ];

    public function hasErrors(): bool
    {
        return ! empty($this->errorOutput);
    }

    public function getOutput(): SpeedtestEntity
    {
        return new SpeedtestEntity(json_decode(parent::getOutput()));
    }
}
