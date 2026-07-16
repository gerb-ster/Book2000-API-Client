<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Response;

/**
 * Result of a successful POST /sales/register call.
 */
final class SaleRegisterResult
{
    public function __construct(
        public readonly int $invoiceId,
        public readonly string $invoiceNumber,
    ) {
    }

    /**
     * @param array<string, mixed> $data The "data" object from the API response.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            invoiceId: (int) ($data['invoice_id'] ?? 0),
            invoiceNumber: (string) ($data['invoice_number'] ?? ''),
        );
    }
}
