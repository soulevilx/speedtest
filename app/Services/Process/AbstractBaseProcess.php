<?php

namespace App\Services\Process;

use App\Models\Process as ProcessModel;
use App\Services\Process\Interfaces\IProcess;
use App\Services\Process\Traits\THasOutput;
use Symfony\Component\Process\Process;

abstract class AbstractBaseProcess implements IProcess
{
    use THasOutput;

    protected int $timeOut = 3600;

    protected array $command = [];

    protected ?string $cwd = null;

    protected ?array $env = null;

    protected ProcessModel $process;

    public function setCommand(array $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function getCommand(): array
    {
        return $this->command;
    }

    public function setCwd(string $cwd): self
    {
        $this->cwd = $cwd;

        return $this;
    }

    public function getCwd(): ?string
    {
        return $this->cwd;
    }

    public function setEnv(?array $env): self
    {
        $this->env = $env;

        return $this;
    }

    public function getEnv(): ?array
    {
        return $this->env;
    }

    public function setTimeOut(int $timeOut): void
    {
        $this->timeOut = $timeOut;
    }

    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    public function execute(): bool
    {
        return $this->run();
    }

    protected function run(): bool
    {
        $process = new Process(
            $this->getCommand(),
            $this->getCwd(),
            $this->getEnv(),
            null,
            $this->getTimeOut(),
        );

        $process->run();

        $this->process = ProcessModel::create([
            'command' => $this->getCommand(),
            'cwd' => $this->getCwd(),
            'env' => $this->getEnv(),
            'output' => $process->getOutput(),
            'error_output' => $process->getErrorOutput(),
            'error_code' => $process->getExitCode(),
        ]);

        return $process->isSuccessful();
    }

    public function getProcess(): ProcessModel
    {
        return $this->process;
    }
}
