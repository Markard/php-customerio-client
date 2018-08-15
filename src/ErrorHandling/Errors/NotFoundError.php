<?php

namespace CustomerIo\ErrorHandling\Errors;

final class NotFoundError extends \RuntimeException
{
    public function __construct($message = 'Service responded with not found status code')
    {
        parent::__construct($message);
    }

    public static function isNotFoundStatusCode(int $statusCode): bool
    {
        return $statusCode === 404;
    }
}
