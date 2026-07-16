<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Exception;

/**
 * Thrown when the request could not be completed at the transport level
 * (connection refused, DNS failure, timeout, ...), i.e. before any HTTP
 * status code was received.
 */
final class NetworkException extends ApiException
{
}
