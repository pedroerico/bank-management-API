<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\AbstractInterfaceDTO;
use Illuminate\Database\Eloquent\Model;

interface AbstractRepositoryInterface
{
    public static function loadModel(): Model;

    public static function find(int $id): Model|null;

    public static function update(int|string $id, array $attributes = []): int;

    public static function create(AbstractInterfaceDTO $dto): Model|null;

    public static function delete(int $id): int;

    public static function validateDTO(AbstractInterfaceDTO $dto): void;
}
