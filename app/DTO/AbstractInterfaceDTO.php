<?php

declare(strict_types=1);

namespace App\DTO;

interface AbstractInterfaceDTO
{
    public function toArray(bool|null $isSnakeCase): array;

    public function toDTO(): self;
}
