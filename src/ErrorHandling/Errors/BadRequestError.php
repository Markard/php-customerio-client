<?php

namespace CustomerIo\ErrorHandling\Errors;

final class BadRequestError extends \LogicException
{
    public function __construct($message = 'Service responded with bad request status code')
    {
        parent::__construct($message);
    }

    public static function isBadRequestErrorStatusCode(int $statusCode): bool
    {
        return $statusCode === 400;
    }
}
