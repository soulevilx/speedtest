<?php

namespace App\Services;

use App\Events\AfterSpeedtestSaved;
use App\Events\BeforeSavingSpeedtest;
use App\Models\Speedtest;
use Illuminate\Support\Facades\Event;
use Symfony\Component\Process\Process;

class SpeedtestService
{
    private array $args = [];

    public function speedtest(
        string $format = 'json',
        ?int   $serverId = null,
    ): Speedtest
    {
        $this->args[] = 'speedtest';
        $this->args[] = '--format=' . $format;

        if ($serverId !== null) {
            $this->args[] = '--server-id=' . $serverId;
        }

        $result = $this->execute($this->args);

        return $this->save($result);
    }

    public function save(string $speedtest): Speedtest
    {
        $result = json_decode($speedtest, true);

        unset($result['type']);
        $result['download_speed'] = $result['download']['bandwidth'];
        $result['upload_speed'] = $result['upload']['bandwidth'];
        $result['internal_ip'] = $result['interface']['internalIp'];
        $result['external_ip'] = $result['interface']['externalIp'];

        Event::dispatch(new BeforeSavingSpeedtest($result));

        $speedtest = Speedtest::create($result);

        Event::dispatch(new AfterSpeedtestSaved($speedtest));

        return $speedtest;
    }

    private function execute(array $args): string
    {
        $process = new Process($args);
        $process->run();

        return $process->getOutput();
    }
}
