<?php

namespace App\Console\Commands;

use App\Services\Speedtest\Entities\SpeedtestEntity;
use App\Services\Speedtest\SpeedtestService;
use Illuminate\Console\Command;

class Speedtest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'speedtest:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute speedtest';

    /**
     * Execute the console command.
     */
    public function handle(SpeedtestService $service): void
    {
        $this->output->text('Starting speedtest');

        $result = $this->speedtest($service);

        if (
            $this->choice('Save speedtest to database?', ['No', 'Yes'], 'Yes') == 'Yes'
        ) {

            $service->save($result);
        }

        $this->output->success('Completed');
    }

    protected function speedtest(SpeedtestService $service): SpeedtestEntity
    {
        $result = $service->speedtest();

        $this->output->info('Ping');
        $rows = $result->getPing();
        $this->table(
            array_keys($rows->toArray()),
            [$rows->toArray()]
        );

        $this->output->info('Download');
        $rows = $result->getDownload();
        $row = $rows->toArray();
        $row['latency'] = json_encode($row['latency']);
        $row['bandwidth'] = $rows->getBandwidth();
        $this->table(
            array_keys($rows->toArray()),
            [$row]
        );

        $this->output->info('Upload');
        $rows = $result->getUpload();
        $row = $rows->toArray();
        $row['latency'] = json_encode($row['latency']);
        $row['bandwidth'] = $rows->getBandwidth() . ' ';
        $this->table(
            array_keys($rows->toArray()),
            [$row]
        );

        return $result;
    }
}
