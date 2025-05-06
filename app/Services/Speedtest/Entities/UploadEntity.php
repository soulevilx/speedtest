<?php

namespace App\Services\Speedtest\Entities;

class UploadEntity extends AbstractBaseEntity
{
    public function getBandwidth(): string
    {
        return round($this->data->bandwidth / 125000, 2) . ' Mbps';
    }
}
