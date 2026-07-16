<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Http;

use Book2000\ApiClient\Exception\NetworkException;

/**
 * Abstraction over the underlying HTTP transport so the client can be used
 * with the bundled curl implementation or any custom transport (e.g. a mock
 * in tests, or a PSR-18 adapter).
 */
interface HttpClientInterface
{
    /**
     * Send an HTTP request and return the response.
     *
     * @param string                $method  HTTP method (GET, POST, ...).
     * @param string                $url     Fully-qualified request URL.
     * @param array<string, string> $headers Request headers as name => value.
     * @param string|null           $body    Raw request body, or null when there is none.
     *
     * @throws NetworkException When the request cannot be completed at the transport level.
     */
    public function send(string $method, string $url, array $headers = [], ?string $body = null): HttpResponse;
}
