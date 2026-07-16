<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Exception;

/**
 * Thrown when the API responds with HTTP 422 (validation error).
 *
 * Mirrors the "ValidationException" response in the OpenAPI definition.
 */
final class ValidationException extends ApiException
{
    /**
     * @param string                     $message      Overview message.
     * @param array<string, list<string>> $errors      Per-field validation error messages.
     * @param int                        $statusCode   HTTP status code (usually 422).
     * @param array<string, mixed>       $responseData Full decoded response body.
     * @param \Throwable|null            $previous     Previous throwable used for exception chaining.
     */
    public function __construct(
        string $message,
        private readonly array $errors = [],
        int $statusCode = 422,
        array $responseData = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $responseData, $previous);
    }

    /**
     * Per-field validation errors, keyed by field name.
     *
     * @return array<string, list<string>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
