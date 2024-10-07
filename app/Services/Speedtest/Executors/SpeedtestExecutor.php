<?php

namespace App\Services\Speedtest\Executors;

use App\Services\Speedtest\Interfaces\ISpeedtestExecutor;
use Symfony\Component\Process\Process;

class SpeedtestExecutor implements ISpeedtestExecutor
{
    public function execute(
        string $format = 'json',
        ?int $serverId = null,
    ): string {
        $args = [];
        $args[] = 'speedtest';
        $args[] = '--format=' . $format;

        if ($serverId !== null) {
            $args[] = '--server-id=' . $serverId;
        }

        $process = new Process($args);
        $process->run();

        return $process->getOutput();
    }
}
