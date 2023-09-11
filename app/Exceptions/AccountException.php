<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class AccountException extends ObjectiveException
{
    protected int $status = Response::HTTP_NOT_FOUND;
}
