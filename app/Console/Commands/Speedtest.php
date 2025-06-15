<?php

namespace App\Console\Commands;

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
    public function handle(): void
    {
        $this->output->text('Starting speedtest');

        \App\Jobs\Speedtest::dispatch();

        $this->output->success('Queued');
    }
}
