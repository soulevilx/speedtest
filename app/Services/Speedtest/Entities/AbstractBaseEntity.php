<?php

namespace App\Services\Speedtest\Entities;

use stdClass;

class AbstractBaseEntity
{
    public function __construct(protected stdClass $data)
    {
    }

    public function __get($name): mixed
    {
        if (! isset($this->data->{$name})) {
            return null;
        }

        return $this->data->{$name};
    }

    public function toArray(): array
    {
        return json_decode(json_encode($this->data), true);
    }

    public function toJson(): string
    {
        return json_encode($this->data);
    }
}
