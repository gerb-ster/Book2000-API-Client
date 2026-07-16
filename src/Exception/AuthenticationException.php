<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Exception;

/**
 * Thrown when the API responds with HTTP 401 (Unauthenticated / Unauthorised).
 *
 * Mirrors the "AuthenticationException" response in the OpenAPI definition.
 */
final class AuthenticationException extends ApiException
{
}
