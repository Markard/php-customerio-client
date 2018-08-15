<?php

namespace CustomerIo\ErrorHandling;

use CustomerIo\ErrorHandling\Errors\BadRequestError;
use CustomerIo\ErrorHandling\Errors\InternalServerError;
use CustomerIo\ErrorHandling\Errors\NotFoundError;
use CustomerIo\ErrorHandling\Errors\UnauthorizedError;

final class StatusCodeValidator
{
    /**
     * @param int $statusCode
     *
     * @throws BadRequestError
     * @throws InternalServerError
     * @throws NotFoundError
     * @throws UnauthorizedError
     */
    public static function validate(int $statusCode): void
    {
        if (InternalServerError::isServerErrorStatusCode($statusCode)) {
            throw new InternalServerError();
        }
        if (BadRequestError::isBadRequestErrorStatusCode($statusCode)) {
            throw new BadRequestError();
        }
        if (NotFoundError::isNotFoundStatusCode($statusCode)) {
            throw new NotFoundError();
        }
        if (UnauthorizedError::isUnauthorizedCode($statusCode)) {
            throw new UnauthorizedError();
        }
    }
}
