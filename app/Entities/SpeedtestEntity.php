<?php

namespace App\Entities;

use App\Entities\Speedtest\DownloadEntity;
use App\Entities\Speedtest\InterfaceEntity;
use App\Entities\Speedtest\PingEntity;
use App\Entities\Speedtest\ResultEntity;
use App\Entities\Speedtest\ServerEntity;
use App\Entities\Speedtest\UploadEntity;
use Carbon\Carbon;
use JOOservices\Entity\AbstractBaseEntity;

/**
 * @property DownloadEntity $download
 * @property string $timestamp
 * @property PingEntity $ping
 * @property UploadEntity $upload
 * @property int $packetLoss
 * @property string $isp
 * @property InterfaceEntity $interface
 * @property ServerEntity $server
 * @property ResultEntity $result
 */
class SpeedtestEntity extends AbstractBaseEntity
{
    protected array $subEntities = [
        'ping' => PingEntity::class,
        'download' => DownloadEntity::class,
        'upload' => UploadEntity::class,
        'interface' => InterfaceEntity::class,
        'server' => ServerEntity::class,
        'result' => ResultEntity::class,
    ];

    protected array $casts = [
        'time' => 'datetime',
    ];

    public function toArray(): array
    {
        $result = parent::toArray();

        $result['download'] = $this->download->toArray();
        $result['upload'] = $this->upload->toArray();
        $result['ping'] = $this->ping->toArray();
        $result['interface'] = $this->interface->toArray();
        $result['server'] = $this->server->toArray();
        $result['result'] = $this->result->toArray();
        $result['download_speed'] = $this->download->bandwidth;
        $result['upload_speed'] = $this->upload->bandwidth;
        $result['internal_ip'] = $this->interface->internalIp;
        $result['external_ip'] = $this->interface->externalIp;

        return $result;
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
