<?php

namespace App\Services\Speedtest\Interfaces;

interface ISpeedtestExecutor
{
    public function execute(
        string $format = 'json',
        ?int $serverId = null,
    ): string;
}
