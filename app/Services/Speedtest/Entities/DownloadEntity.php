<?php

namespace App\Services\Speedtest\Entities;

class DownloadEntity extends AbstractBaseEntity
{
    public function getBandwidth(): string
    {
        return round($this->data->bandwidth / 125000, 2) . ' Mbps';
    }
}
