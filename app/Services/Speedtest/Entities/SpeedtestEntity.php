<?php

namespace App\Services\Speedtest\Entities;

use Carbon\Carbon;
use stdClass;

/**
 * @property stdClass $data
 * @property string $timestamp
 * @property stdClass $ping
 * @property stdClass $download
 * @property stdClass $upload
 * @property int $packetLoss
 * @property string $isp
 * @property stdClass $interface
 * @property stdClass $server
 * @property stdClass $result
 */
class SpeedtestEntity extends AbstractBaseEntity
{
    public function getData(): stdClass
    {
        return $this->data;
    }

    public function getTime(): Carbon
    {
        return Carbon::parse($this->timestamp);
    }

    public function getPing(): PingEntity
    {
        return new PingEntity($this->ping);
    }

    public function getDownload(): DownloadEntity
    {
        return new DownloadEntity($this->download);
    }

    public function getUpload(): UploadEntity
    {
        return new UploadEntity($this->upload);
    }

    public function getPacketLoss(): float
    {
        return $this->packetLoss;
    }

    public function getIsp(): string
    {
        return $this->isp;
    }

    public function getInterface(): InterfaceEntity
    {
        return new InterfaceEntity($this->interface);
    }

    public function getServer(): ServerEntity
    {
        return new ServerEntity($this->server);
    }

    public function getResult(): ResultEntity
    {
        return new ResultEntity($this->result);
    }

    public function getResultUrl(): string
    {
        return $this->data->result->url;
    }
}
