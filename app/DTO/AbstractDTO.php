<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Support\Str;

abstract class AbstractDTO implements AbstractInterfaceDTO
{
    public function toArray(bool|null $isSnakeCase = true): array
    {
        $properties = get_object_vars($this);
        $array = [];

        foreach ($properties as $property => $value) {
            $property = $isSnakeCase ? Str::snake($property) : $property;
            $array[$property] = $value;
        }

        return $array;
    }

    public function toDTO(): self
    {
        return new static(...array_values($this->toArray()));
    }
}
