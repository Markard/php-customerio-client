<?php

namespace CustomerIo\ErrorHandling\Errors;

final class InternalServerError extends \RuntimeException
{
    public function __construct($message = 'Service responded with server error')
    {
        parent::__construct($message);
    }

    public static function isServerErrorStatusCode(int $statusCode): bool
    {
        return $statusCode >= 500 && $statusCode < 600;
    }
}
