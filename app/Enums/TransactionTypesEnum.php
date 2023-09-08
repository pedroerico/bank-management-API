<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\EnumsToArrayTrait;

enum TransactionTypesEnum: string
{
    use EnumsToArrayTrait;

    case CREDIT_CARD = 'C';
    case DEBIT_CARD = 'D';
    case PIX = 'P';

    public static function getNameFromAcronym(TransactionTypesEnum $acronym): string
    {
        return match ($acronym) {
            self::CREDIT_CARD => 'Cartão de Crédito',
            self::DEBIT_CARD => 'Cartão de Débito',
            self::PIX => 'Pix'
        };
    }

    public static function getRateFromAcronym(TransactionTypesEnum $acronym): float
    {
        return match ($acronym) {
            self::CREDIT_CARD => 5.00,
            self::DEBIT_CARD => 3.00,
            self::PIX => 0.00
        };
    }
}
