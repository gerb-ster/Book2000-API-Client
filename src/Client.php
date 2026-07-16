<?php

declare(strict_types=1);

namespace Book2000\ApiClient;

use Book2000\ApiClient\Exception\ApiException;
use Book2000\ApiClient\Exception\AuthenticationException;
use Book2000\ApiClient\Exception\ValidationException;
use Book2000\ApiClient\Http\CurlHttpClient;
use Book2000\ApiClient\Http\HttpClientInterface;
use Book2000\ApiClient\Http\HttpResponse;
use Book2000\ApiClient\Request\BatchRegisterRequest;
use Book2000\ApiClient\Request\LoginRequest;
use Book2000\ApiClient\Request\SaleRegisterRequest;
use Book2000\ApiClient\Response\BatchRegisterResult;
use Book2000\ApiClient\Response\SaleRegisterResult;

/**
 * Standalone PHP client for the Book2000App API.
 *
 * Generated from the OpenAPI 3.1 definition. It has no framework dependency
 * and only relies on the curl and json extensions.
 */
final class Client
{
    private string $baseUri;

    private HttpClientInterface $httpClient;

    private ?string $token;

    /**
     * @param string                   $baseUri    Base URL of the API, e.g. "http://book.home:8488/api".
     * @param HttpClientInterface|null $httpClient Custom transport; defaults to a curl-based client.
     * @param string|null              $token      Optional bearer token for authenticated requests.
     */
    public function __construct(
        string $baseUri = 'http://book.home:8488/api',
        ?HttpClientInterface $httpClient = null,
        ?string $token = null,
    ) {
        $this->baseUri = rtrim($baseUri, '/');
        $this->httpClient = $httpClient ?? new CurlHttpClient();
        $this->token = $token;
    }

    /**
     * The bearer token currently used for authenticated requests, if any.
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set (or clear, with null) the bearer token used for authenticated requests.
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * Authenticate a user and store the returned bearer token on the client.
     *
     * POST /auth/login
     *
     * @return string The issued bearer token.
     *
     * @throws AuthenticationException When the credentials are invalid (HTTP 401).
     * @throws ValidationException     When the request fails validation (HTTP 422).
     * @throws ApiException            On any other error response.
     */
    public function login(LoginRequest $request): string
    {
        $response = $this->request('POST', '/auth/login', $request->toArray(), false);

        $token = $response['data'] ?? null;
        if (!is_string($token)) {
            throw new ApiException('The login response did not contain a valid token.', 200, $response);
        }

        $this->token = $token;

        return $token;
    }

    /**
     * Log the currently authenticated user out and clear the local token.
     *
     * GET /auth/logout
     *
     * @throws AuthenticationException When no valid session exists (HTTP 401).
     * @throws ApiException            On any other error response.
     */
    public function logout(): void
    {
        $this->request('GET', '/auth/logout');
        $this->token = null;
    }

    /**
     * Register a batch (Inkoop).
     *
     * POST /batches/register
     *
     * @throws AuthenticationException When the request is not authenticated (HTTP 401).
     * @throws ValidationException     When the request fails validation (HTTP 422).
     * @throws ApiException            On any other error response (e.g. HTTP 500).
     */
    public function registerBatch(BatchRegisterRequest $request): BatchRegisterResult
    {
        $response = $this->request('POST', '/batches/register', $request->toArray());

        /** @var array<string, mixed> $data */
        $data = is_array($response['data'] ?? null) ? $response['data'] : [];

        return BatchRegisterResult::fromArray($data);
    }

    /**
     * Register a sale (Verkoop).
     *
     * POST /sales/register
     *
     * @throws AuthenticationException When the request is not authenticated (HTTP 401).
     * @throws ValidationException     When the request fails validation (HTTP 422).
     * @throws ApiException            On any other error response (e.g. HTTP 500).
     */
    public function registerSale(SaleRegisterRequest $request): SaleRegisterResult
    {
        $response = $this->request('POST', '/sales/register', $request->toArray());

        /** @var array<string, mixed> $data */
        $data = is_array($response['data'] ?? null) ? $response['data'] : [];

        return SaleRegisterResult::fromArray($data);
    }

    /**
     * Perform an HTTP request, decode the JSON body and turn error responses
     * into the appropriate exceptions.
     *
     * @param string                    $method        HTTP method.
     * @param string                    $path          Path relative to the base URI (must start with "/").
     * @param array<string, mixed>|null $body          Request payload to be JSON-encoded, or null.
     * @param bool                      $authenticated Whether to send the bearer token.
     *
     * @return array<string, mixed> The decoded response body.
     *
     * @throws AuthenticationException
     * @throws ValidationException
     * @throws ApiException
     */
    private function request(string $method, string $path, ?array $body = null, bool $authenticated = true): array
    {
        $headers = [
            'Accept' => 'application/json',
        ];

        $encodedBody = null;
        if ($body !== null) {
            $encodedBody = json_encode($body, JSON_THROW_ON_ERROR);
            $headers['Content-Type'] = 'application/json';
        }

        if ($authenticated && $this->token !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->token;
        }

        $response = $this->httpClient->send($method, $this->baseUri . $path, $headers, $encodedBody);

        return $this->handleResponse($response);
    }

    /**
     * @return array<string, mixed>
     *
     * @throws AuthenticationException
     * @throws ValidationException
     * @throws ApiException
     */
    private function handleResponse(HttpResponse $response): array
    {
        $data = $response->json();
        $status = $response->statusCode;

        if ($status >= 200 && $status < 300) {
            return $data;
        }

        $message = is_string($data['message'] ?? null) ? $data['message'] : 'The API returned an error.';

        if ($status === 401) {
            throw new AuthenticationException($message, $status, $data);
        }

        if ($status === 422) {
            /** @var array<string, list<string>> $errors */
            $errors = is_array($data['errors'] ?? null) ? $data['errors'] : [];

            throw new ValidationException($message, $errors, $status, $data);
        }

        throw new ApiException($message, $status, $data);
    }
}
