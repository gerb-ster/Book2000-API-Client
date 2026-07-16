<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Tests\Support;

use Book2000\ApiClient\Http\HttpClientInterface;
use Book2000\ApiClient\Http\HttpResponse;

/**
 * Simple in-memory HTTP transport used to test the client without any network.
 */
final class MockHttpClient implements HttpClientInterface
{
    /** @var list<array{method: string, url: string, headers: array<string, string>, body: string|null}> */
    public array $calls = [];

    /**
     * @param list<HttpResponse> $responses Responses returned in order, one per call.
     */
    public function __construct(private array $responses)
    {
    }

    public function send(string $method, string $url, array $headers = [], ?string $body = null): HttpResponse
    {
        $this->calls[] = [
            'method' => $method,
            'url' => $url,
            'headers' => $headers,
            'body' => $body,
        ];

        if ($this->responses === []) {
            throw new \RuntimeException('MockHttpClient has no more queued responses.');
        }

        return array_shift($this->responses);
    }

    /**
     * @return array{method: string, url: string, headers: array<string, string>, body: string|null}
     */
    public function lastCall(): array
    {
        return $this->calls[array_key_last($this->calls)];
    }
}
