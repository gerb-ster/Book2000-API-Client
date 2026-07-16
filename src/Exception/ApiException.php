<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Exception;

/**
 * Base exception for any error returned by the Book2000 API.
 */
class ApiException extends \RuntimeException
{
    /**
     * @param string               $message      Human readable error message.
     * @param int                  $statusCode   HTTP status code (0 when no response was received).
     * @param array<string, mixed> $responseData Decoded response body, when available.
     * @param \Throwable|null      $previous     Previous throwable used for exception chaining.
     */
    public function __construct(
        string $message,
        private readonly int $statusCode = 0,
        private readonly array $responseData = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array<string, mixed>
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }
}
