<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Http;

/**
 * Minimal, transport-agnostic representation of an HTTP response.
 */
final class HttpResponse
{
    /**
     * @param int    $statusCode HTTP status code.
     * @param string $body       Raw response body.
     */
    public function __construct(
        public readonly int $statusCode,
        public readonly string $body,
    ) {
    }

    /**
     * Decode the JSON body into an associative array.
     *
     * @return array<string, mixed>
     */
    public function json(): array
    {
        if ($this->body === '') {
            return [];
        }

        $decoded = json_decode($this->body, true);

        return is_array($decoded) ? $decoded : [];
    }
}
