<?php

namespace App\Services\Process\Traits;

use App\Models\Process as ProcessModel;

trait THasOutput
{
    public function getErrorOutput(): string
    {
        return $this->process->error_output;
    }

    public function getOutput(): mixed
    {
        return $this->process->output;
    }

    public function getErrorCode(): int
    {
        return $this->process->error_code;
    }

    public function getModel(): ProcessModel
    {
        return $this->process;
    }
}
