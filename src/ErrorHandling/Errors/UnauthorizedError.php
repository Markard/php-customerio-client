<?php

namespace CustomerIo\ErrorHandling\Errors;

final class UnauthorizedError extends \LogicException
{
    public function __construct($message = 'Service responded with unauthorized error')
    {
        parent::__construct($message);
    }

    public static function isUnauthorizedCode(int $statusCode): bool
    {
        return $statusCode === 401;
    }
}
