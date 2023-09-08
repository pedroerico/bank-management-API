<?php

declare(strict_types=1);

namespace App\Helpers;

class Utils
{
    public static function getCalculateInterest(float $value, float $rate): float
    {
        return round(($rate / 100) * $value, 2);
    }
}
