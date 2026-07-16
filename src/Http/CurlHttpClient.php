<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Http;

use Book2000\ApiClient\Exception\NetworkException;

/**
 * Dependency-free HTTP client based on the curl extension.
 */
final class CurlHttpClient implements HttpClientInterface
{
    /**
     * @param int $timeout        Maximum time in seconds the request is allowed to take.
     * @param int $connectTimeout Maximum time in seconds to wait while connecting.
     */
    public function __construct(
        private readonly int $timeout = 30,
        private readonly int $connectTimeout = 10,
    ) {
        if (!\extension_loaded('curl')) {
            throw new \RuntimeException('The "curl" PHP extension is required to use CurlHttpClient.');
        }
    }

    public function send(string $method, string $url, array $headers = [], ?string $body = null): HttpResponse
    {
        $handle = curl_init();

        $curlHeaders = [];
        foreach ($headers as $name => $value) {
            $curlHeaders[] = $name . ': ' . $value;
        }

        curl_setopt_array($handle, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $curlHeaders,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_CONNECTTIMEOUT => $this->connectTimeout,
            CURLOPT_FOLLOWLOCATION => false,
        ]);

        if ($body !== null) {
            curl_setopt($handle, CURLOPT_POSTFIELDS, $body);
        }

        $rawBody = curl_exec($handle);

        if ($rawBody === false) {
            $errorMessage = curl_error($handle);
            $errorNumber = curl_errno($handle);
            curl_close($handle);

            throw new NetworkException(
                sprintf('HTTP request to "%s" failed: %s (curl error %d).', $url, $errorMessage, $errorNumber),
            );
        }

        $statusCode = (int) curl_getinfo($handle, CURLINFO_RESPONSE_CODE);
        curl_close($handle);

        return new HttpResponse($statusCode, (string) $rawBody);
    }
}
