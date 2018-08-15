<?php

namespace CustomerIo\ErrorHandling;

use CustomerIo\ErrorHandling\Errors\BadRequestError;
use CustomerIo\ErrorHandling\Errors\InternalServerError;
use CustomerIo\ErrorHandling\Errors\NotFoundError;
use CustomerIo\ErrorHandling\Errors\UnauthorizedError;
use Exception;
use Guzzle\Http\Exception\RequestException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Logs exceptions with appropriate log levels and rich context.
 */
final class Logger
{
    /**
     * @var LoggerInterface
     */
    private $psrLogger;

    public function __construct(LoggerInterface $psrLogger)
    {
        $this->psrLogger = $psrLogger;
    }

    public function log(Exception $exception, Context $context): void
    {
        $logLevel = $this->determineLogLevel($exception);
        $this->psrLogger->log($logLevel, Context::ERROR_MESSAGE, $context->buildContext($exception));
    }

    private function determineLogLevel(Exception $exception): string
    {
        if ($this->isTimeoutException($exception)) {
            return LogLevel::ERROR;
        }
        if ($exception instanceof InternalServerError) {
            return LogLevel::ERROR;
        }
        if ($exception instanceof BadRequestError) {
            return LogLevel::CRITICAL;
        }
        if ($exception instanceof UnauthorizedError) {
            return LogLevel::CRITICAL;
        }
        if ($exception instanceof NotFoundError) {
            return LogLevel::WARNING;
        }

        return LogLevel::CRITICAL;
    }

    /**
     * Timeout exceptions are quite common in our distributed environment, and should be treated in a uniform way.
     * For example, Guzzle's RequestException is thrown in case of any connectivity issue, including timeout.
     * There might be other exceptions that indicate the timeout issue. Add them there upon discovery.
     *
     * @param Exception $exception
     *
     * @return bool
     */
    private function isTimeoutException(Exception $exception): bool
    {
        return $exception instanceof RequestException;
    }
}
