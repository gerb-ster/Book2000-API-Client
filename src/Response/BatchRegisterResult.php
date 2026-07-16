<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Response;

/**
 * Result of a successful POST /batches/register call.
 */
final class BatchRegisterResult
{
    public function __construct(
        public readonly int $transactionId,
    ) {
    }

    /**
     * @param array<string, mixed> $data The "data" object from the API response.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            transactionId: (int) ($data['transaction_id'] ?? 0),
        );
    }
}
