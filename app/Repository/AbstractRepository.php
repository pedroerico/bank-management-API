<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\AbstractInterfaceDTO;
use App\Factories\Model\ModelAdapterFactoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class AbstractRepository
{
    protected static ModelAdapterFactoryInterface $adapterFactory;

    public function __construct(ModelAdapterFactoryInterface $adapterFactory)
    {
        self::$adapterFactory = $adapterFactory;
    }

    protected static $model;

    public static function loadModel(): Model
    {
        return self::$adapterFactory->createAdapter(app(static::$model))->adapt();
    }

    public static function find(int $id): Model|null
    {
        return self::loadModel()::query()->find($id);
    }

    public static function update(int|string $id, array $attributes = []): int
    {
        return self::loadModel()::query()->where(['id' => $id])->update($attributes);
    }

    public static function create(AbstractInterfaceDTO $dto): Model|null
    {
        self::validateDTO($dto);
        return self::loadModel()::query()->create($dto->toArray());
    }

    public static function delete(int $id): int
    {
        return self::loadModel()::query()->where(['id' => $id])->delete();
    }

    public static function validateDTO(AbstractInterfaceDTO $dto): void
    {
        $fillable = self::loadModel()->getFillable();
        $data = $dto->toArray();
        $intersect = array_intersect_key($data, array_flip($fillable));
        if (count($intersect) !== count($data)) {
            Log::error(
                "As propriedades da classe " . get_class($dto) .
                " não são compatíveis com as da classe " . get_class(self::loadModel())
            );
            throw new \InvalidArgumentException('Dados inválidos');
        }
    }
}
