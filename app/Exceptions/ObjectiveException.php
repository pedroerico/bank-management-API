<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ObjectiveException extends Exception
{
    protected int $status = Response::HTTP_INTERNAL_SERVER_ERROR;

    public function getStatus(): int
    {
        return $this->status;
    }
}
