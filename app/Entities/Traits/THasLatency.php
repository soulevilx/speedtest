<?php

namespace App\Entities\Traits;

trait THasLatency
{
    public function getIqm(): float
    {
        return $this->latancy->iqm;
    }
    public function getLow(): float
    {
        return $this->latancy->low;
    }
    public function getHigh(): float
    {
        return $this->latancy->high;
    }
    public function getJitter(): float
    {
        return $this->latancy->jitter;
    }
}
