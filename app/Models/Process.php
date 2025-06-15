<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use Uuids;

    protected $fillable = [
        'uuid',
        'command',
        'cwd',
        'env',
        'error_code',
        'error_output',
        'output',
    ];

    protected $casts = [
        'uuid' => 'string',
        'command' => 'array',
        'cwd' => 'string',
        'env' => 'array',
        'error_code' => 'int',
        'error_output' => 'string',
        'output' => 'string',
    ];
}
