<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

class Speedtest extends Model
{
    use Uuids;

    protected $fillable = [
        'hostname',
        'ip',
        'ping',
        'download',
        'upload',
        'packetLoss',
        'isp',
        'interface',
        'server',
        'result',
        'download_speed',
        'upload_speed',
        'internal_ip',
        'external_ip',
    ];

    protected $casts = [
        'hostname' => 'string',
        'ip' => 'string',
        'ping' => 'array',
        'download' => 'array',
        'upload' => 'array',
        'packetLoss' => 'float',
        'isp' => 'string',
        'interface' => 'array',
        'server' => 'array',
        'result' => 'array',
        'download_speed' => 'int',
        'upload_speed' => 'int',
        'internal_ip' => 'string',
        'external_ip' => 'string',
    ];
}
