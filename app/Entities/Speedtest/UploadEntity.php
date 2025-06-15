<?php

namespace App\Entities\Speedtest;

use App\Entities\Traits\THasBandwidth;
use App\Entities\Traits\THasLatency;
use JOOservices\Entity\AbstractBaseEntity;

class UploadEntity extends AbstractBaseEntity
{
    use THasBandwidth;
    use THasLatency;
}
