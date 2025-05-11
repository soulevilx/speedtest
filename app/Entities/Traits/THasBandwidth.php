<?php

namespace App\Entities\Traits;

/**
 * @property int $bandwidth
 * @property int $bytes
 * @property int $elapsed
 */
trait THasBandwidth
{
    public function getBandwidth(): string
    {
        return round($this->bandwidth / 125000, 2) . ' Mbps';
    }
}
