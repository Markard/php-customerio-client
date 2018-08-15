<?php

namespace CustomerIo\ErrorHandling;

use Exception;
use Psr\Http\Message\ResponseInterface;

final class Context
{
    public const ERROR_MESSAGE = 'Integration error. Service: customer.io.';

    private $additionalInfo;

    /**
     * Response body might not yet be defined when context is needed.
     *
     * @var null|ResponseInterface
     */
    private $response;

    public function __construct(array $additionalInfo = [])
    {
        $this->additionalInfo = $additionalInfo;
    }

    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function buildContext(Exception $exception): array
    {
        $context = [
            'exception' => $exception,
            'additionalInfo' => $this->additionalInfo,
        ];
        if ($this->response !== null) {
            $context['response'] = [
                'body' => $this->response->getBody(),
                'headers' => $this->response->getHeaders(),
                'statusCode' => $this->response->getStatusCode(),
                'reasonPhrase' => $this->response->getReasonPhrase()
            ];
        }

        return $context;
    }
}
