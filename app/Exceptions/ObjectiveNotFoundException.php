<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ObjectiveNotFoundException extends Exception
{
    protected int $status = Response::HTTP_NOT_FOUND;
}

