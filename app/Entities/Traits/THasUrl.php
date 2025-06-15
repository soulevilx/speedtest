<?php

namespace App\Entities\Traits;

trait THasUrl
{
    public function getUrl(): string
    {
        return $this->url;
    }
}
